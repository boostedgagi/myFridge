"use strict";
const add = document.querySelector("#add");
const plus = document.querySelector("#plus");
const minus = document.querySelector("#minus");
let amount = document.querySelector("#amount");

add.addEventListener("click", () => (amount.value = "1"));

plus.addEventListener("click", () => {
  let number = parseInt(amount.value);
  number += 1;
  amount.value = number.toString();
});

minus.addEventListener("click", () => {
  let number = parseInt(amount.value);
  if (number <= 0) {
  } else {
    number -= 1;
    amount.value = number.toString();
  }
});