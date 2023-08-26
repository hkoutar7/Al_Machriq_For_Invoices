setInterval(() => {
    let count = $("#countUnreadInvoices");
    let invoices = $("#UnreadInvoices");

    count.load(`${window.location.href} #countUnreadInvoices`);

    invoices.load(`${window.location.href} #UnreadInvoices`);
}, 5000);
