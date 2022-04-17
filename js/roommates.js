let autocompleteArray= [];
$.ajax ( {
    url: "./roommates.php",
    dataType: "json",
    success: function ( data, textStatus, jqXHR ) {
        let counter=0;
        for(let item of data){
            autocompleteArray[counter] = item;
            counter++;
        }
    }
} );

console.log(autocompleteArray);
function autocompleteMatch(input) {
    if (input === '') {
        return [];
    }
    let reg = new RegExp(input)
    return autocompleteArray.filter(function(term) {
        if (term.match(reg)) {
            return term;
        }
    });
}

function showResults(val) {
    let result = document.getElementById("resultDiv");
    result.innerHTML = '';
    let list = '';
    let terms = autocompleteMatch(val);
    for (i=0; i<terms.length; i++) {
        list += '<li>' + terms[i] + '</li>';
    }
    result.innerHTML = '<ul>' + list + '</ul>';
}