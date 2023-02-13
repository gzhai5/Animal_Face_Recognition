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
// const saveButton = document.getElementById('save-button');
// saveButton.addEventListener('click', event => {
//   // Get image data from 'taken photo' img element
//   const img = document.getElementById('taken-photo');
//   const imageData = img.src;
//   localStorage.setItem("image_face", imageData);

  // Download image
  // const link = document.createElement('a');
  // link.download = 'input.jpeg';
  // link.href = imageData;
  // link.click();
// });