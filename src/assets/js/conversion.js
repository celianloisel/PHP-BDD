console.log("script chargé !");
console.log(document.cookie);

var result = document.getElementById('amount-convert-to');
var amount = document.getElementById('amount').value;

result.value = document.cookie * amount;
console.log(result.value);