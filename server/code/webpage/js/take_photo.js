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
  fetch('http://localhost:8085/process-image', {
    method: 'POST',
    headers: {
      'Content-Type': 'text/plain'
    },
    body: JSON.stringify(photoDataUrl)
  })
  .then(response => response.json())
  .then(data => {
    // Redirect the user to the result page with the ML result in the query string
    // const resultUrl = `./html/loader.html`;
    // window.location.href = resultUrl;
    var pred_animal = data["result"]; 
    if (pred_animal.includes("cat")) {
        setTimeout(function() {
        window.location.href = "result/result_cat.html";
        }, 10000);
    } else if (pred_animal.includes("dog")) {
        setTimeout(function() {
        window.location.href = "result/result_dog.html";
        }, 10000);
    } else if (pred_animal.includes("tiger")) {
        setTimeout(function() {
        window.location.href = "result/result_tiger.html";
        }, 10000);
    } else if (pred_animal.includes("fox")) {
        setTimeout(function() {
        window.location.href = "result/result_fox.html";
        }, 10000);
    } else if (pred_animal.includes("koala")) {
        setTimeout(function() {
        window.location.href = "result/result_koala.html";
        }, 10000);
    } else if (pred_animal.includes("lion")) {
        setTimeout(function() {
        window.location.href = "result/result_lion.html";
        }, 10000);
    } else if (pred_animal.includes("rabbit")) {
        setTimeout(function() {
        window.location.href = "result/result_rabbit.html";
        }, 10000);
    } else {
        setTimeout(function() {
        window.location.href = "result/result_tiger.html";
        }, 10000);
    }
  })
  .catch(error => console.error(error));
});


