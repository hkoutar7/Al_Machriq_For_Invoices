


function pickerInvoiceSelector(typeSelector) {

    let invoiceType = document.getElementById("inv-type");
    let invStartDate = document.getElementById("inv-date-start");
    let invEndDate = document.getElementById("inv-date-end");
    let invNumber = document.getElementById("inv-number");

    if (typeSelector == 1) {
        invoiceType.style.display = "block";
        invStartDate.style.display = "block";
        invEndDate.style.display = "block";
        invNumber.style.display = "none";
    } else {
        invNumber.style.display = "block";
        invoiceType.style.display = "none";
        invStartDate.style.display = "none";
        invEndDate.style.display = "none";
    }


}
