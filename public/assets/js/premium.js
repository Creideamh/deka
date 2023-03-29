$("#premium_savings").on("change", function () {
    premium_savings = $("#premium_savings").val();
    premium_risk = $("#premium_risk").val();
    premium_fee = $("#premium_fee").val();

    total =
        Number(premium_risk) + Number(premium_savings) + Number(premium_fee);

    premium_total = $("#premium_total").val(total);
});

flatpickr("#premium_birthdate", {
    dateFormat: "Y-m-d",
});

function payeeAge() {
    $age = $("#premium_birthdate").val();

    if (calcAge($age) <= 40) {
        $("#submit").prop("disabled", true); // prevent form submission
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "error",
            title: "   Payee cannot be a minor",
        });
    } else {
        $("#submit").prop("disabled", false);
    }
}
