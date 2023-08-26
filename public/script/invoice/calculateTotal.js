function calculateTotal() {

    let commission = Number(document.getElementById("amount_commission").value);
    let discount = Number(document.getElementById("discount").value);
    let ind = document.getElementById("rate_vat").value.indexOf("%");
    let rate_vat = document.getElementById("rate_vat").value.substring(0, ind);

    let resultVat = document.getElementById("value_vat");
    let total = document.getElementById("total");

    if (typeof commission != NaN && typeof discount != NaN) {
        if (commission) {
            resultVat.value = (
                ((commission - discount) * rate_vat) /
                100
            ).toFixed(3);

            total.value = (
                (commission - discount) *
                (1 + rate_vat / 100)
            ).toFixed(3);

        } else window.alert("املئ العمولة");
        
    } else console.log("problem");
}
