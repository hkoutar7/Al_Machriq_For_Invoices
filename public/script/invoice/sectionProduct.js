$(document).ready(function () {

    $('select[name="section"]').on("change", function () {
        var SectionId = $(this).val();
        if (SectionId) {
            $.ajax({
                url: "/sections/product/" + SectionId,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="product"]').empty();
                    $.each(data, function (key, value) {
                        $('select[name="product"]').append(
                            '<option value="' +
                                value +
                                '">' +
                                key +
                                "</option>"
                        );
                    });
                },
            });
            console.log("suceess")
        } else {
            console.log("AJAX load did not work");
        }
    });

});
