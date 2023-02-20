const urlParams = new URLSearchParams(window.location.search);
const result = urlParams.get('result');
console.log(result); // or do something else with the result

var pred_animal = result; 
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
