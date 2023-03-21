<!-- sample modal content -->
<div>
    <div id="myEditModal" class="modal fade editBeneficiaryForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Beneficiary Information 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"     aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit.beneficiary.info')}}" id="edit-beneficiary-form" method="post">
                        <div class="row">
                            <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                            <input type="hidden" name="trustee_id" id="trustee_id">
                            <input type="hidden" name="beneficiary_id" id="beneficiary_id`">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="eSurname" id="eSurname" class="form-control">
                                    <span class="text-danger error-text eSurname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="eFirstname" id="eFirstname" class="form-control">
                                    <span class="text-danger error-text eFirstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="eGender" id="eGender" class="form-control">
                                        <option value=""></option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                    <span class="text-danger error-text eGender_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Birthdate</label>
                                    <input type="text" class="form-control" onchange="displayTrust()" id="eBirthdate"  name="eBirthdate">
                                    <span class="text-danger error-text eBirthdate_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Relationship</label>
                                    <select name="eRelationship" id="eRelationship" class="form-control">
                                        <option value=""></option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Child">Child</option>
                                    </select>
                                    <span class="text-danger error-text eRelationship_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Benefit Percentage</label>
                                    <input type="number" min="0.0" max="100.00" step="any" class="form-control" id="eBenefit" name="eBenefit">
                                    <span class="text-danger error-text eBenefit_error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Beneficiary Contact</label>
                                    <input type="text" name="eContact" class="form-control" id="eContact" />
                                    <span class="text-danger error-text eContact_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row trustee_card">
                            <hr>

                            <div class="col-12"><p><strong>Trustee</strong></p></div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="eTrustee_surname" id="eTrustee_surname" class="form-control">
                                    <span class="text-danger error-text eTrustee_surname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="eTrustee_firstname" id="eTrustee_firstname" class="form-control">
                                    <span class="text-danger error-text eTrustee_firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="eTrustee_gender" id="eTrustee_gender" class="form-control">
                                        <option value=""></option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                    <span class="text-danger error-text eTrustee_gender_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Birthdate</label>
                                    <input type="text" name="eTrustee_birthdate" onchange="eTrusteeAge"  id="eTrustee_birthdate" class="form-control">
                                    <span class="text-danger error-text eTrustee_birthdate_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Relationship</label>
                                    <select class="form-control" name="eTrustee_relationship" id="eTrustee_relationship" style="width: 100%;">
                                        <option value=""></option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Child">Child</option>
                                    </select>
                                    <span class="text-danger error-text eTrustee_relationship_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Address</label>
                                    <textarea name="eTrustee_address" id="eTrustee_address" cols="30" rows="10" class="form-control"></textarea>
                                    <span class="text-danger error-text eTrustee_address_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Contact</label>
                                    <input type="text" name="eTrustee_contact" id="eTrustee_contact" class="form-control">
                                    <span class="text-danger error-text eTrustee_contact_error"></span>
                                </div>
                            </div>
                        </div>
                </div><!-- end of modal body -->
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="eSubmit">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
@push('customerJS')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script>
        flatpickr("#eBirthdate", {
            dateFormat: "Y-m-d",
        });
        $(function(){
            $('#edit-beneficiary-form').on('submit',function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend: function(){
                        $(form).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code === 0){
                            $.each(data.error, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 2){
                            toastr.error(data.msg); 
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 3){
                            toastr.error(data.msg); 
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 4){
                            toastr.error(data.msg); 
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 1){
                            toastr.success(data.msg); 
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                            $('#beneficiaries').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('#myModal').modal('hide'); // hide modal
                        }else if(data.code === 5){
                            $.each(data.error, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else{
                            toastr.error(data.msg); 
                            $('.editBeneficiaryForm').find('form')[0].reset(); // resets form fields
                            $('#myModal').modal('hide'); // hide modal
                        }
                    }
                })
            })
        })

function calcAge(dateString) {
    var birthday = +new Date(dateString);
    return ~~((Date.now() - birthday) / 31557600000);
}

$(".trustee_card").hide();


function displayTrust() {
    // get beneficiary to set trustees table
    var trusteeDate = $("#eBirthdate").val();
    if (calcAge(trusteeDate) < 18) {
        $(".trustee_card").show();
    } else {
        $(".trustee_card").hide();
    }

}

flatpickr("#eTrustee_birthdate", {
    dateFormat: "Y-m-d",
});

// Trustee must be 40 and above
function eT rusteeAge() {
    $age = $("#eTrustee_birthdate").val();

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
</script>
@endpush