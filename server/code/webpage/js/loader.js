var imageData = localStorage.getItem("image_face");
var image = document.getElementById("image");
image.src = imageData;
image.style.display = "none"; 
const img = image;

const predictImage = async () => {
console.log("Model loading...");
const model = await mobilenet.load();
console.log("Model is loaded!")

const predictions = await model.classify(img);
var pred_animal = predictions[0].className;
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

console.log(typeof predictions[0])
console.log('Predictions: ', predictions[0]);
}
predictImage();