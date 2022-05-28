
let hamburger = document.querySelectorAll(".hamburger");
let clicked = false;
function rotating() {
  
  if (clicked === false) {
    hamburger[1].style.transform = "scale(0)";
    hamburger[0].style.cssText = "transform-origin: center; transform: translateY(7px) rotate(45deg); ";
    hamburger[2].style.cssText = "transform-origin: center; transform: translateY(-7px) rotate(-45deg) ";
    clicked = true;
  } else if(clicked === true) {
    hamburger[1].style.transform = "scale(1)";
    hamburger[0].style.transform = "rotate(0deg)";
    hamburger[2].style.transform = "rotate(0deg)";
    clicked = false;
  }
};

function validation(){

   let email = document.querySelector("#login-email");
    let passwd = document.querySelector('#login-password');
    let validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
  
    if(email.value === ""){
      email.classList.add('is-invalid');
    }
    else {
      email.classList.remove('is-invalid');
    }
    if(passwd.value === ""){
      passwd.classList.add('is-invalid');
    }
    else {
      passwd.classList.remove('is-invalid');
    }
    if(!validRegex.test(String(email).toLowerCase())){
      email.classList.add("is-invalid");
      document.querySelector("div > div > #login-email").value = "Please fill the right format email";
    }
    else{
      email.classList.remove("is-invalid");
      document.querySelector("div > div > #login-email").value = "Please fill the email.";
      }
      return passwd.value !== "" && email.value !== "" && validRegex.test(String(email).toLowerCase());
    }