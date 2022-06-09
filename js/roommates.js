// "use strict";
// let autocompleteArray = [];
// $.ajax({
//   url: "./roommates.php",
//   dataType: "json",
//   success: function (data, textStatus, jqXHR) {
//     let counter = 0;
//     for (let item of data) {
//       autocompleteArray[counter] = item;
//       counter++;
//     }
//   },
// });

// console.log(autocompleteArray);
// function autocompleteMatch(input) {
//   if (input === "") {
//     return [];
//   }
//   let reg = new RegExp(input);
//   return autocompleteArray.filter(function (term) {
//     if (term.match(reg)) {
//       return term;
//     }
//   });
// }

// function showResults(val) {
//   let result = document.getElementById("show-list");
//   result.innerHTML = "";
//   let list = "";
//   let terms = autocompleteMatch(val);
//   for (let i = 0; i < terms.length; i++) {
//     list +=
//       '<div class="my-2 border-bottom">Click here<span><b> ' +
//       terms[i] +
//       "</b><span></div>";
//   }
//   result.innerHTML =
//     '<div class="bg-white p-3 w-100 rounded-2">' + list + "</div>";
// }
