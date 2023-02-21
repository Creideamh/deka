$('#premium_savings').on('change', function () {
    premium_savings = $('#premium_savings').val();
    premium_risk = $('#premium_risk').val();
    premium_fee = $('#premium_fee').val()

    total = Number(premium_risk) + Number(premium_savings) + Number(premium_fee);

    premium_total = $('#premium_total').val(total);
})

flatpickr('#premium_birthdate', {
    dateFormat: 'Y-m-d'
});