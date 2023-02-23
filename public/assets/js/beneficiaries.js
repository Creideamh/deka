$(document).ready(function () {
    // Add new row in the beneficiary member table
    $("#add_beneficiary_row")
        .unbind("click")
        .bind("click", function () {
            var table = $("#beneficiaries");
            var count_table_tbody_tr = $("#beneficiaries tbody tr").length;
            var row_id = count_table_tbody_tr + 1;

            var totalSubAmount = 0;
            for (x = 0; x < count_table_tbody_tr; x++) {
                var tr = $("#beneficiaries tbody tr")[x];
                var count = $(tr).attr("id");
                console.log(count);
                count = count.substring(5);

                totalSubAmount =
                    Number(totalSubAmount) +
                    Number($("#beneficiary_benefit_" + count).val());
            } // /for
            totalSubAmount = totalSubAmount.toFixed(2);

            if (row_id <= 12) {
                // Ensure 12 rows

                // Ensure that percentages are exactly 100
                if (totalSubAmount < 100) {
                    var html =
                        '<tr id="brow_' +
                        row_id +
                        '">' +
                        '<td><input type="text" name="beneficiary_name[]" id="beneficiary_name_' +
                        row_id +
                        '" class="form-control"></td>' +
                        "<td>" +
                        '<select name="beneficiary_gender[]" id="beneficiary_gender_' +
                        row_id +
                        '"class="form-control beneficiary_gender_' +
                        row_id +
                        ' select2 select2bs5">' +
                        '<option value=""></option>' +
                        '<option value="M">Male</option>' +
                        '<option value="F">Female</option>' +
                        "</select>" +
                        "</td>" +
                        "<td>" +
                        '<input type="text" class="form-control"  id="beneficiary_date_' +
                        row_id +
                        '" onchange="displayTrust(\'' +
                        row_id +
                        '\')"  name="beneficiary_date[]">' +
                        "</td>" +
                        "<td>" +
                        '<select name="beneficiary_relationship[]" id="beneficiary_relationship' +
                        row_id +
                        '" class="form-control beneficiarySelect' +
                        row_id +
                        ' select2bs5">' +
                        '<option value=""></option>' +
                        '<option value="Spouse">Spouse</option>' +
                        '<option value="Father">Father</option>' +
                        '<option value="Mother">Mother</option>' +
                        '<option value="Child">Child</option>' +
                        '<option value="Brother">Brother</option>' +
                        '<option value="Sister">Sister</option>' +
                        "</select>" +
                        "</td>" +
                        "<td>" +
                        '<input type="number" min="0.0" max="100.00" onchange="checkPercentage(\'' +
                        row_id +
                        '\')"  step="any" class="form-control" id="beneficiary_benefit_' +
                        row_id +
                        '"  name="beneficiary_benefit[]">' +
                        "</td>" +
                        "<td>" +
                        '<input type="text" class="form-control" id="beneficiary_contact_' +
                        row_id +
                        '" name="beneficiary_contact[]">' +
                        "</td>" +
                        "<td>" +
                        '<button class="btn btn-danger" id="browButton_' +
                        row_id +
                        '" onclick="removeBrow(\'' +
                        row_id +
                        '\')"><i class="ti-close"></i></button>' +
                        "</td>" +
                        "</tr>";

                    if (count_table_tbody_tr >= 1) {
                        $("#beneficiaries tbody tr:last").after(html);
                    } else {
                        $("#beneficiaries tbody").html(html);
                    }

                    flatpickr("#beneficiary_date_" + row_id, {
                        dateFormat: "Y-m-d",
                    });

                    // When you enter a value in the proposed family member input the other inputs become a must fill out
                    $("#beneficiary_name_" + row_id).on(
                        "change keyup keypress keydown paste click",
                        function () {
                            $("#beneficiary_date" + row_id).attr(
                                "required",
                                true
                            );
                            $("#beneficiary_gender_" + row_id).attr(
                                "required",
                                true
                            );
                            $("#beneficiary_relationship" + row_id).attr(
                                "required",
                                true
                            );
                            $("#beneficiary_benefit_" + row_id).attr(
                                "required",
                                true
                            );
                            $("#beneficiary_contact_" + row_id).attr(
                                "required",
                                true
                            );
                        }
                    );

                    // When you enter a value in the proposed family member input the other inputs become a must fill out
                    $("#beneficiary_name_" + row_id).on(
                        "change keyup keypress keydown paste click",
                        function () {
                            $("#tDateBirth" + row_id).attr("required", true);
                            $("#tGender" + row_id).attr("required", true);
                            $("#tRelation" + row_id).attr("required", true);
                            $("#tAddress" + row_id).attr("required", true);
                            $("#tContact" + row_id).attr("required", true);
                        }
                    );
                } else {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                    });

                    Toast.fire({
                        icon: "error",
                        title: "  Exhausted Beneficiary Percentage. Percentage must either be 100 or add up to a 100",
                    });
                }
            } else {
                var Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "error",
                    title: "   Maximum 12 slots for beneficiaries",
                });
            } // End if(row_id <= 12)
        });
});

// remove added row from beneficiary table
function removeBrow(tr_id) {
    $("#beneficiaries tbody tr#brow_" + tr_id).remove();
}

$(".trustee_card").hide();
function displayTrust(row_id) {
    // get beneficiary to set trustees table
    var trusteeDate = $("#beneficiary_date_" + row_id).val();
    if (calcAge(trusteeDate) < 18) {
        $(".trustee_card").show();
    } else {
        $(".trustee_card").hide();
    }
}

flatpickr("#trustee_birthdate", {
    dateFormat: "Y-m-d",
});

// Trustee must be 40 and above
function trusteeAge() {
    $age = $("#trustee_birthdate").val();

    if (calcAge($age) < 40) {
        $("#submit").prop("disabled", true); // prevent form submission
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "error",
            title: "   Trustee must be over 40 years, cannot be a minor",
        });
    } else {
        $("#submit").prop("disabled", false);
    }
}

/**
 * If only one beneficiary, must have a 100% benefit
 */
function checkPercentage(row_id) {
    $percentage = $("#benefit_percentage").val();
    var table = $("#beneficiaries");
    var count_table_tbody_tr = $("#beneficiaries tbody tr").length;

    if (count_table_tbody_tr === 1 && $percentage < 100) {
        $("#submit").prop("disabled", true); // prevent form submission
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "error",
            title: "   Trustee must be over 40 years, cannot be a minor",
        });
    }
}
