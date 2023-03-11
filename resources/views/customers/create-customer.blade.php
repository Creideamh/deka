
<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">
                    Create Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customer.create')}}" id="add-customer-form" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Policy Number</label>
                                <input type="text" name="policy_number" id="policy_number" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Title </label>
                                <select name="title" id="title" class="form-select">
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Sir">Sir</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Surname</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Birthdate </label>
                                <input type="text" class="form-control" id="birthdate" onchange="customerAge()" name="birthdate" readonly="readonly">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">BirthPlace</label>
                                <input type="text" name="birthplace" id="birthplace" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Occupation</label>
                                <input type="text" name="occupation" id="occupation" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-select">
                                    <option value=""></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="divorced">Divorced</option>
                                    <option value="separated">Separated</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Nationality</label>
                                <select name="nationality" id="country" class="form-select">
                                    <option value="">--------------------</option>
                                    @forelse ($countries as $country)
                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">Phone-number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="">@Email</label>
                                <input type="email" name="email_address" id="email_address" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Home Address</label>
                                <input type="text" name="home_address" id="home_address" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Postal Address</label>
                                <input type="text" name="postal_address" id="postal_address" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">TIN Number</label>
                                <input type="text" name="tin_number" id="tin_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Form of Identification</label>
                                <select name="form_of_identification" id="form_of_identifcation" class="form-select">
                                    <option value="">----------------------</option>
                                    <option value="passport">Passport</option>
                                    <option value="ssnit">SSNIT</option>
                                    <option value="voter_id">Voter's ID</option>
                                    <option value="driver_license">Driver's License</option>
                                    <option value="national_id">National ID</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Identiy Number</label>
                                <input type="text" name="identity_number" id="identity_number" class="form-control">
                            </div>
                        </div>
                    </div>
                
            </div>
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
<!-- /.modal -->
@push('customerJS')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script>
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
    </script>
    <script>
        $(function(){
            $('#add-customer-form').on('submit',function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                    url:$(form).attr('action'),
                    method:$(form).attr('method'),
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    success:function(data){
                        if(data.code === 0){
                            toastr.error(data.msg); 
                        }else{
                            toastr.success(data.msg); 
                        }
                    }
                })
            })
        })
    </script>
@endpush