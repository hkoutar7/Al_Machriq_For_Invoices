function printContent() {
    let Invoice = document.getElementById("printCard").innerHTML;
    let content = document.body.innerHTML;

    document.body.innerHTML = Invoice;
    window.print();
    document.body.innerHTML = content;

    location.reload();
}
