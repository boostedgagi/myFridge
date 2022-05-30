
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