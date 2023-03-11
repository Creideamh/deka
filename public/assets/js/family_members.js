flatpickr("#birthdate", {
    dateFormat: "Y-m-d",
});

// premium deduction
flatpickr("#premium_deduction", {
    dateFormat: "Y-m-d",
});

// Customer must be 21 and above
function customerAge() {
    $age = $("#birthdate").val();

    if (calcAge($age) <= 21) {
        $("#submit").prop("disabled", true); // prevent form submission
        var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
        });
        Toast.fire({
            icon: "error",
            title: "   Customer cannot be a minor",
        });
    } else {
        $("#submit").prop("disabled", false);
    }
}

$(document).ready(function () {
    // Add new row in the family members to be insured table
    $("#add_row")
        .unbind("click")
        .bind("click", function () {
            var table = $("#family_members");
            var count_table_tbody_tr = $("#family_members tbody tr").length;
            // var row_id = count_table_tbody_tr + 1;
            var row_id = count_table_tbody_tr + 1;

            if (row_id <= 12) {
                var html =
                    '<tr id="row_' +
                    row_id +
                    '">' +
                    "<td>" +
                    '<input type="text" name="fullname[]" id="fullname_' +
                    row_id +
                    '" class="form-control" required>' +
                    "</td>" +
                    "<td>" +
                    '<select class="form-control select' +
                    row_id +
                    '" name="gender_of_member[]" id="gender_' +
                    row_id +
                    '"  style="width: 100%;" required>' +
                    '<option value=""></option>' +
                    '<option value="Male">Male</option>' +
                    '<option value="Female">Female</option>' +
                    "</select>" +
                    "</td>" +
                    '<td><input type="text" class="form-control"  id="birthdate_of_member_' +
                    row_id +
                    '" name="birthdate_of_member[]"></td>' +
                    "<td>" +
                    '<select class="form-control" name="relationship_of_member[]" id="relationship_of_member_' +
                    row_id +
                    '" onchange="getBenefits(\'' +
                    row_id +
                    '\')" style="width: 100%;" required>' +
                    '<option value=""></option>' +
                    '<option value="Spouse">Spouse</option>' +
                    '<option value="Parents">Parents</option>' +
                    '<option value="Child">Child</option>' +
                    '<option value="Extended">Extended</option>' +
                    "</select>" +
                    "</td>" +
                    "<td>" +
                    '<input type="text" class="form-control" id="standard_premium_' +
                    row_id +
                    '" value="" name="standard_premium[]">' +
                    "</td>" +
                    "<td>" +
                    '<select class="form-control" name="optional_benefits[]" onchange="getOptionals(\'' +
                    row_id +
                    '\')" id="optional_benefits_' +
                    row_id +
                    '" style="width: 100%;" required>' +
                    '<option value=""></option>' +
                    '<option value="40DB">40DB</option>' +
                    '<option value="ANR">ANR</option>' +
                    '<option value="HSB">HSB</option>' +
                    "</select>" +
                    "</td>" +
                    "<td>" +
                    '<input type="text" class="form-control"  id="optional_premium_' +
                    row_id +
                    '"  name="optional_premium[]">' +
                    "</td>" +
                    "<td>" +
                    '<button class="btn btn-danger" onclick="removeRow(\'' +
                    row_id +
                    '\')"><i class="ti-close"></i></button>' +
                    "</td>" +
                    "</tr>";

                if (count_table_tbody_tr >= 1) {
                    $("#family_members tbody tr:last").after(html);
                } else {
                    $("#family_members tbody").html(html);
                }

                flatpickr("#birthdate_of_member_" + row_id, {
                    dateFormat: "Y-m-d",
                });
            } else {
                var Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "error",
                    title: "   Maximum 12 slots for family Members",
                });
            }
        });
});

// update values in first row of family  table
$("#surname, #firstname").on("change", function () {
    var surname = $("#surname").val();
    var firstname = $("#firstname").val();
    var fullname = surname.concat(" " + firstname);
    $("#fullname_1").val(fullname);
});

$("#gender").on("change", function () {
    var gender = $("#gender").val();
    $("#gender_1").val(gender);
});

// automatically populate Risk premium input with monthly Risk
// Premium value
$("#monthly_premium").on("change", function () {
    $("#premium_risk").val($("#monthly_premium"));
});

$("#birthdate").on("change", function () {
    var dob = $("#birthdate").val();
    $("#birthdate_of_member_1").val(dob);
});

// remove added row from family member table
function removeRow(tr_id) {
    $("#family_members tbody tr#row_" + tr_id).remove();
    subAmount();
}

// get the optional benefit values from the server
function getBenefits(row_id) {
    var benefit_id = $("#benefits").val();
    var age = $("#birthdate_of_member_" + row_id).val();
    var relationship = $("#relationship_of_member_" + row_id).val();
    var newage = calcAge(age);
    $.ajax({
        url:
            location.protocol +
            "//" +
            location.hostname +
            ":8000/standard-premium",
        type: "POST",
        data: {
            benefit_id: benefit_id,
            newage: newage,
            relationship: relationship,
        },
        dataType: "json",
        success: function (data) {
            // setting the rate value into the rate input field
            if (data.details.length == 0) {
                $("#standard_premium_" + row_id).val(0.0);
            } else {
                $("#standard_premium_" + row_id).val(data.details[0].STP);
            }
            subAmount(row_id);
        }, // /success
    }); // /ajax function to fetch the product data
}

// get the optional benefit values from the server
function getOptionals(row_id) {
    var option_id = $("#optional_benefits_" + row_id).val();
    var dateOfBirth = $("#birthdate_of_member_" + row_id).val();
    var relationship = $("#relationship_of_member_" + row_id).val();
    var benefit = $("#benefits").val();
    var newage = calcAge(dateOfBirth);

    var dataString =
        "option_id=" +
        option_id +
        "&newage=" +
        newage +
        "&relationship=" +
        relationship +
        "&benefit=" +
        benefit;
    $.ajax({
        url:
            location.protocol +
            "//" +
            location.hostname +
            ":8000/optional-premium",
        type: "POST",
        data: dataString,
        dataType: "json",
        success: function (response) {
            if (option_id == "40DB") {
                if (response.details.length == 0) {
                    $("#optional_premium_" + row_id).val(0.0);
                } else {
                    $("#optional_premium_" + row_id).val(
                        response.details[0].FDB
                    );
                }
            } else if (option_id == "HSB") {
                if (response.details.length == 0) {
                    $("#optional_premium_" + row_id).val(0.0);
                } else {
                    $("#optional_premium_" + row_id).val(
                        response.details[0].HSB
                    );
                }
            } else {
                if (response.details.length == 0) {
                    $("#optional_premium_" + row_id).val(0.0);
                } else {
                    $("#optional_premium_" + row_id).val(
                        response.details[0].ANR
                    );
                }
            }

            // setting the rate value into the rate input field
            // $("#optionalBenefit_"+row_id).val(response.details[0].option_id);
            subAmount(row_id);

            //var valued =  $("#optionalBenefit_"+row_id).val(response);
        }, // /success
    }); // /ajax function to fetch the product data
}

function calcAge(dateString) {
    var birthday = +new Date(dateString);
    return ~~((Date.now() - birthday) / 31557600000);
}

function deleteFam(id) {
    $.ajax({
        url:
            location.protocol +
            "//" +
            location.hostname +
            ":8000/delete-family-member",
        type: "POST",
        data: { member_id: id },
        dataType: "json",
        success: function (data) {
            // setting the rate value into the rate input field
            if (data.code == 1) {
                var Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "success",
                    title: "   Member dropped successfully",
                });

                removeRow(id);
            } else {
                var Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                });
                Toast.fire({
                    icon: "error",
                    title: "   Cannot remove the Main Life",
                });
            }
        }, // /success
    }); // /aj
}

// Sum Monthly Premium
function subAmount() {
    var tableProductLength = $("#family_members tbody tr").length;
    var totalSubAmount = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#family_members tbody tr")[x];
        var count = $(tr).attr("id");
        count = count.substring(4);

        totalSubAmount =
            Number(totalSubAmount) +
            Number($("#standard_premium_" + count).val()) +
            Number($("#optional_premium_" + count).val());
        console.log($("#standard_premium_" + count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
    $("#monthly_premium").val(totalSubAmount);
}
