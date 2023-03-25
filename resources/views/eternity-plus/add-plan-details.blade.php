<!-- sample modal content -->
<div id="myModal" class="modal fade addPlanForm" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Family Member 
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"     aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.family.member')}}" id="add-member-form" method="post">
                    <div class="row">
                        <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="">Benefits</label>
                                <select name="proposed_sum" id="proposed_sum" class="form-select">
                                    <option value=""></option>
                                    <option value="5000">Jasper ---- 5000</option>
                                    <option value="7500">Onyx ---- 7500</option>
                                    <option value="10000">Jade ---- 10000</option>
                                    <option value="20000">Amber ---- 20000</option>
                                    <option value="30000">Topaz ---- 30000</option>
                                    <option value="50000">Sapphire ---- 50000</option>
                                    <option value="60000">Emerald ---- 60000</option>
                                </select>
                            </div>
                            <span class="text-danger error-text proposed_sum_error"></span>                     
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Surname</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                            <span class="text-danger error-text surname_error"></span>                     
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                                <span class="text-danger error-text firstname_error"></span>                     
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Birthdate </label>
                                <input type="text" class="form-control" id="birthdate" onchange="customerAge()" name="birthdate">
                                <span class="text-danger error-text birhdate_error"></span>                     
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Gender</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <span class="text-danger error-text gender_error"></span>                     
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Family Relationship</label>
                                <select name="relationship" id="relationship" onclick="getBenefits()" class="form-select">
                                    <option value="Main Life">Main Life</option>
                                    <option value="Spouse">Spouse</option>
                                    <option value="parents">Parents</option>
                                    <option value="Extended">Extended</option>
                                </select>                            
                            </div>
                            <span class="text-danger error-text relationship_error"></span>                     
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Standard Premium</label>
                                <input type="text" name="standard_premium" id="standard_premium" class="form-control" readonly>
                                <span class="text-danger error-text standard_premium_error"></span>                     
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Optional Benefit</label>
                                <select name="optional_benefit" id="optional_benefit" onchange="getOptionals()" class="form-control">
                                    <option value="40DB">40DB</option>
                                    <option value="ANR">ANR</option>
                                    <option value="HSB">HSB</option>
                                </select>
                                <span class="text-danger error-text optional_benefit_error"></span>                     
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Optional Premium</label>
                                <input type="text" name="optional_premium" id="optional_premium" class="form-control" readonly>
                                <span class="text-danger error-text optional_premium_error"></span>                     
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
@push('customerJS')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script>
        $(function(){
            $('#add-member-form').on('submit',function(e){
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
                            $.each(data.errors, function(prefix, value){
                                $(form).find('span.'+prefix+'_error').text(value[0]);
                            });
                        }else if(data.code == 2){
                            toastr.error(data.msg); 
                        }else{
                            toastr.success(data.msg); 
                            $('#family_members').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('.addPlanForm').find('form')[0].reset(); // resets form fields
                            $('#myModal').modal('hide'); // hide modal
                        }
                    }
                })
            })
        })
    </script>
    <script>
        flatpickr("#birthdate", {
            dateFormat: "Y-m-d",
        });
                // Calculate age
        function calcAge(dateString) {
            var birthday = +new Date(dateString);
            return ~~((Date.now() - birthday) / 31557600000);
        }
        // // Customer must be 21 and above
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

        // get the optional benefit values from the server
        function getBenefits() {
            var benefit_id = $("#proposed_sum").val();
            var age = $("#birthdate").val();
            var relationship = $("#relationship").val();
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
                        $("#standard_premium").val(0.0);
                    } else {
                        $("#standard_premium").val(data.details[0].STP);
                    }
                    // subAmount(row_id);
                }, // /success
            }); // /ajax function to fetch the product data
        }

        // get the optional benefit values from the server
        function getOptionals() {
            var option_id = $("#optional_benefit").val();
            var dateOfBirth = $("#birthdate").val();
            var relationship = $("#relationship").val();
            var benefit = $("#proposed_sum").val();
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
                            $("#optional_premium").val(0.0);
                        } else {
                            $("#optional_premium").val(
                                response.details[0].FDB
                            );
                        }
                    } else if (option_id == "HSB") {
                        if (response.details.length == 0) {
                            $("#optional_premium").val(0.0);
                        } else {
                            $("#optional_premium").val(
                                response.details[0].HSB
                            );
                        }
                    } else {
                        if (response.details.length == 0) {
                            $("#optional_premium").val(0.0);
                        } else {
                            $("#optional_premium").val(
                                response.details[0].ANR
                            );
                        }
                    }

                    // setting the rate value into the rate input field
                    // $("#optionalBenefit_"+row_id).val(response.details[0].option_id);
                    // subAmount(row_id);

                    //var valued =  $("#optionalBenefit_"+row_id).val(response);
                }, // /success
            }); // /ajax function to fetch the product data
        }

    </script>
@endpush