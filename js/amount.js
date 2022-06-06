const add = document.querySelector("#add");
const plus = document.querySelector("#plus");
const minus = document.querySelector("#minus");
let amount = document.querySelector("#amount");

<<<<<<< HEAD
add.addEventListener("click", () => (amount.value = "1 Amountunit"));

plus.addEventListener("click", () => {
  let number = parseInt(amount.value);
  number += 1;
  amount.value = number.toString() + " Amountunit";
});

minus.addEventListener("click", () => {
  let number = parseInt(amount.value);
  if (number <= 0) {
  } else {
    number -= 1;
    amount.value = number.toString() + " Amountunit";
  }
});
=======
add.addEventListener("click", ()=> amount.value = "1");

plus.addEventListener("click", ()=> {
    let number = parseInt(amount.value);
    number += 1;
    amount.value = number.toString();
});

minus.addEventListener("click", ()=> {
    let number = parseInt(amount.value);
    if(number <= 0) {
    }
    else {
        number -= 1;
        amount.value = number.toString();
    }
});

>>>>>>> 86d41b278da7822f76b6ffb5bba5ad71375f8d0c
