let spans = document.querySelectorAll(".buttons-invoice span");

function Choice(id) {
    spans.forEach((e) => {
        if (e.classList.contains("active")) {
            e.classList.remove("active");
        }
    });

    spans[id - 1].classList.add("active");
}
