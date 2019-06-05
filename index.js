window.onload = function() {
    let inputElement1 = document.getElementById("password");
    let inputElement = document.getElementById("confirmPassInput");
    inputElement1.onchange = function() {
        checkValue(inputElement1);
    }
    inputElement.onchange = function() {
        checkValue(inputElement);
    }
}

function checkValue(element) {
    let size = element.value.length;
    let pattern = "[a-zA-z]*[0-9]+";
    let matched = element.value.match(pattern);
    if (!matched) {
        element.style = "border: 1px solid red";
    } else if (size < 7) {
        element.style = "border: 1px solid red";
    } else {
        element.style = "border: none";
    }
}