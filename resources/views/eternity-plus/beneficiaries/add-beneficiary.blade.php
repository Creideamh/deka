<!-- sample modal content -->
<div>
    <div id="myModal" class="modal fade addBeneficiaryForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Beneficiary Information 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"     aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add.beneficiary')}}" id="add-beneficiary-form" method="post">
                        <div class="row">
                            <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control">
                                    <span class="text-danger error-text surname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control">
                                    <span class="text-danger error-text firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value=""></option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Birthdate</label>
                                    <input type="text" class="form-control" onchange="displayTrust()" id="birthdate"  name="birthdate">
                                    <span class="text-danger error-text birthdate_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Relationship</label>
                                    <select name="relationship" id="relationship" class="form-control">
                                        <option value=""></option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Child">Child</option>
                                    </select>
                                    <span class="text-danger error-text relationship_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Benefit Percentage</label>
                                    <input type="number" min="0.0" max="100.00" step="any" class="form-control" id="benefit" name="benefit">
                                    <span class="text-danger error-text benefit_error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Beneficiary Contact</label>
                                    <input type="text" name="contact" class="form-control" id="contact" />
                                    <span class="text-danger error-text contact_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row trustee_card">
                            <hr>

                            <div class="col-12"><p><strong>Trustee</strong></p></div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="trustee_surname" id="trustee_surname" class="form-control">
                                    <span class="text-danger error-text trustee_surname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="trustee_firstname" id="trustee_firstname" class="form-control">
                                    <span class="text-danger error-text firstname_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Gender</label>
                                    <select name="trustee_gender" id="trustee_gender" class="form-control">
                                        <option value=""></option>
                                        <option value="F">Female</option>
                                        <option value="M">Male</option>
                                    </select>
                                    <span class="text-danger error-text trustee_gender_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Birthdate</label>
                                    <input type="text" name="trustee_birthdate" onchange="trusteeAge()"  id="trustee_birthdate" class="form-control">
                                    <span class="text-danger error-text trustee_birthdate_error"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="">Relationship</label>
                                    <select class="form-control" name="trustee_relationship" id="trustee_relationship" style="width: 100%;">
                                        <option value=""></option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Spouse">Spouse</option>
                                        <option value="Child">Child</option>
                                    </select>
                                    <span class="text-danger error-text trustee_relationship_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Address</label>
                                    <textarea name="trustee_address" id="trustee_address" cols="30" rows="10" class="form-control"></textarea>
                                    <span class="text-danger error-text trustee_address_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Contact</label>
                                    <input type="text" name="trustee_contact" id="trustee_contact" class="form-control">
                                    <span class="text-danger error-text trustee_contact_error"></span>
                                </div>
                            </div>
                        </div>
                </div><!-- end of modal body -->
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
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
        flatpickr("#birthdate", {
            dateFormat: "Y-m-d",
        });
        $(function(){
            $('#add-beneficiary-form').on('submit',function(e){
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
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 2){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 3){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 4){
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else if(data.code === 1){
                            toastr.success(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                            $('#beneficiaries').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('#myModal').modal('hide'); // hide modal
                        }else if(data.code === 5){
                            $.each(data.error, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
                        }else{
                            toastr.error(data.msg); 
                            $('.addBeneficiaryForm').find('form')[0].reset(); // resets form fields
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
    var trusteeDate = $("#birthdate").val();
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
    </script>
@endpush