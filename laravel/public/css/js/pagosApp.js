/*
Inspired by Florin Pop's coding challenges, you can check them here: https://www.florin-pop.com/blog/2019/03/weekly-coding-challenge/
*/

// UI Elements & globals
const form = document.getElementById("test-form"),
      messageBox = document.querySelector(".message"),
      inputs = document.querySelectorAll("input");
let timer;

// Create random classname
function randomClass() {
  const classes = new Map([
    [1, "info"],
    [2, "warning"],
    [3, "error"],
    [4, "success"]
  ]);
 
  const rndNum = Math.floor(Math.random() * 4) + 1;
  return classes.get(rndNum);
}

// Set classname
function setClass(className) {
  messageBox.className = "message";
  messageBox.classList.add(className);
  }

// Create message
function createMessage(message, field) {
  const alert = document.createElement("p");
  alert.textContent = `${field}: ${message}`;
  messageBox.appendChild(alert);
  messageBox.classList.remove("hide");
}

// Clear messages
function clearMessages() {
  messageBox.classList.add("hide");
  messageBox.innerHTML = "";
}

// Detect invalid inputs and set messages
inputs.forEach(function(current) {
  current.addEventListener("invalid", function(e) {
    createMessage(e.target.validationMessage, e.target.title);
    e.preventDefault();
  })
})

// Changes on submission attempt
document.querySelector("input[type=submit]").addEventListener("click", function(e) {
  messageBox.innerHTML = "";
  clearTimeout(timer);
  timer = setTimeout(clearMessages, 5000);
  setClass(randomClass());
})

// On form submission
form.addEventListener("submit", function(e) {
  createMessage("Form submitted successfuly", "Form");
  setClass("success");
  inputs.forEach(function(current) {
    if(current.type != "submit") {
    current.value = "";
    }
  })
  e.preventDefault();
})