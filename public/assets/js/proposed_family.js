/**Medical Information **/

// Display proposed family members table when
$(".proposed").hide();
$(".form-check-input").click(function () {
    if ($('input[name="medical_health_status"]:checked').val() === "No") {
        $(".proposed").show(300);
    } else {
        $(".proposed").hide(200);
    }
});

// Display If Yes, Please provide policy number
$(".if_yes").hide();
$(".if_yes_checked").click(function () {
    if ($('input[name="existing_policy"]:checked').val() === "Yes") {
        $(".if_yes").show();
        $("#if_yes").attr("required", true);
    } else {
        $(".if_yes").hide();
        $("#if_yes").removeAttr("required");
    }
});

// Display If Yes, Please state the reason for refusal
$(".refusal").hide();
$(".refusal_checked").click(function () {
    if ($('input[name="existing_life_insurance"]:checked').val() === "Yes") {
        $(".refusal").show();
        $("#refusal").attr("required", true);
    } else {
        $(".refusal").hide();
        $("#refusal").removeAttr("required");
    }
});

/**
 * This section of code handles the edit-eternity.blade.php file
 */
$(".refusal_edit_checkbox").click(function () {
    if ($('input[name="existing_life_insurance"]:checked').val() === "Yes") {
        $(".refusal_edit").show();
        $("#refusal_edit").attr("required", true);
    } else if (
        $('input[name="existing_life_insurance"]:checked').val() === "No"
    ) {
        $(".refusal_edit").hide();
    }
});

$(".if_yes_edit_checked").click(function () {
    if ($('input[name="existing_policy"]:checked').val() === "Yes") {
        $(".if_yes_edit").show();
        $("#if_yes_edit").attr("required", true);
    } else if ($('input[name="existing_policy"]:checked').val() === "No") {
        $(".if_yes_edit").hide();
    }
});

$(".proposed_edit").hide();
$(".form-check-input").click(function () {
    if ($('input[name="medical_health_status"]:checked').val() === "Yes") {
        $(".proposed_edit").hide(300);
    } else if (
        $('input[name="medical_health_status"]:checked').val() === "No"
    ) {
        $(".proposed_edit").show(200);
    }
});
/****END */

// Add new row in the proposed family member table
$("#add_proposed_family_member_row")
    .unbind("click")
    .bind("click", function () {
        var table = $("#proposed_family_members");
        var count_table_tbody_tr = $(
            "#proposed_family_members tbody tr"
        ).length;
        var row_id = count_table_tbody_tr + 1;

        var html =
            '<tr id="add_proposed_row_' +
            row_id +
            '">' +
            '<td><input type="text" name="proposed_family_member[]" id="proposed_family_member_' +
            row_id +
            '" class="form-control"></td>' +
            "<td>" +
            '<input type="text" class="form-control" id="illness_injury_' +
            row_id +
            '" name="illness_injury[]"  style="width: 100%;">' +
            "<td>" +
            '<input type="text" class="form-control"  id="hospital_' +
            row_id +
            '" name="hospital[]">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control"  id="duration_' +
            row_id +
            '" name="duration[]">' +
            "</td>" +
            "<td>" +
            '<input type="text" class="form-control" id="present_condition_' +
            row_id +
            '" name="present_condition[]">' +
            "</td>" +
            "<td>" +
            '<button class="btn btn-danger" onclick="remove_proposed_family_member_row(\'' +
            row_id +
            '\')"><i class="ti-close"></i></button>' +
            "</td>" +
            "</tr>";

        if (count_table_tbody_tr >= 1) {
            $("#proposed_family_members tbody tr:last").after(html);
        } else {
            $("#proposed_family_members tbody").html(html);
        }

        // When you enter a value in the proposed family member input the other inputs become a must fill out
        $("#proposed_family_member_" + row_id).on(
            "change keyup keypress keydown paste click",
            function () {
                $("#illness_injury_" + row_id).attr("required", true);
                $("#hospital_" + row_id).attr("required", true);
                $("#duration_" + row_id).attr("required", true);
                $("#present_condition_" + row_id).attr("required", true);
            }
        );
    });

// remove added row from proposed family member table
function remove_proposed_family_member_row(tr_id) {
    $("#proposed_family_members tbody tr#add_proposed_row_" + tr_id).remove();
}
