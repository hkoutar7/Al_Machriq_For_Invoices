let myRateVal = document.getElementById("rate_vat");

let rateVal = ["5%", "10%", "15%"];

rateVal.forEach(function (e) {
    myRateVal.innerHTML += `<option>${e}</option>`;
});
