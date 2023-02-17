// Set up video stream
const video = document.getElementById('webcam-stream');
navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => {
    video.srcObject = stream;
    video.play();
  });

// Set up photo capture button
const captureButton = document.getElementById('capture-button');
captureButton.addEventListener('click', event => {
  // Create canvas element to display photo
  const canvas = document.createElement('canvas');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const context = canvas.getContext('2d');
  context.drawImage(video, 0, 0);

  // Set taken photo as source of 'taken photo' img element
  const img = document.getElementById('taken-photo');
  img.src = canvas.toDataURL('image/png');

  // Enable save&jump button
  document.getElementById('jump-button').disabled = false;
});

// Set up save photo button
const jumpButton = document.getElementById('jump-button');
jumpButton.addEventListener('click', event => {
  // Get the captured photo from the 'taken-photo' img element
  const img = document.getElementById('taken-photo');
  const photoDataUrl = img.src;

  // Send the photo to the Flask container
  fetch('/process-image', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ photoDataUrl })
  })
  .then(response => response.json())
  .then(data => {
    // Redirect the user to the result page with the ML result in the query string
    const resultUrl = `./html/loader.html`;
    window.location.href = resultUrl;
  })
  .catch(error => console.error(error));
});