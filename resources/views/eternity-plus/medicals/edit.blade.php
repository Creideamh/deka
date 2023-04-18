@extends('layouts.app-layout')

@section('title', 'Edit Family Member Details')
@push('toastrCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
@endpush

@push('dataTablesCss')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('SweetAlertCss')
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('flatpickrCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/css/flatpickr.min.css') }}" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Medicals</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Family</a></li>
                    <li class="breadcrumb-item"><a href="#">Eternity Plus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Medicals</li>
                </ol>
            </div>
            <div class="col-md-4">
                <div class="float-end d-none d-md-block">
                    <button type="button" class="btn btn-success float-end me-2 mb-3" id="edit_row" data-bs-toggle="modal" data-bs-target="#myModal">
                        <i class="ti-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Medical Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.medical', [ 'id' => $medicalInfo[0]->id ])}}" method="POST" id="edit-medicals-form">
                        <input type="hidden" name="application_id" value="{{ $medicalInfo[0]->application_id}}">
                        <div class="col-md-8 float-start">
                            <label for="">Do you currently have an existing Life Policy with FNB? </label>
                            <div class="form-check">
                                <input class="form-check-input if_yes_edit_checked" type="radio" name="existing_policy" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input if_yes_edit_checked" type="radio" name="existing_policy" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        @if ($medicalInfo[0]->existing_policy == 'Yes')
                            <div class="col-md-4 if_yes_edit float-end">
                                <label for="">If <span class="text-danger">Yes</span>, please provide policy number:</label>
                                <input type="text" name="existing_policy_number" id="if_yes_edit" class="form-control" value="{{ $medicalInfo[0]->existing_policy_number }}">
                            </div>
                        @else
                            <div class="col-md-4 if_yes_edit float-end">
                                <label for="">If <span class="text-danger">Yes</span>, please provide policy number:</label>
                                <input type="text" name="existing_policy_number" id="if_yes" class="form-control">
                            </div>
                        @endif
                        <div class="col-md-8 float-start">
                            <label for="">Has any Life Insurance Company refused your proposal for Life Insurance or accepted with an extra premium or special terms on any of the proposed lives?</label>
                            <div class="form-check">
                                <input class="form-check-input refusal_edit_checkbox" type="radio" name="existing_life_insurance" value="Yes"> 
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input refusal_edit_checkbox" type="radio" name="existing_life_insurance" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                        @if ($medicalInfo[0]->life_insurance_status == 'Yes')
                            <div class="col-md-4 float-end refusal_edit" >
                                <label for="">If <span class="text-danger">Yes</span> please state the reason for refusal</label>
                                <input type="text" name="refusal" id="refusal" value="{{ $medicalInfo[0]->refusal_reasons }}"  class="form-control">
                            </div>
                        @else
                            <div class="col-md-4 float-end refusal_edit" >
                                <label for="">If <span class="text-danger">Yes</span> please state the reason for refusal</label>
                                <input type="text" name="refusal" id="refusal_edit" class="form-control">
                            </div>
                        @endif
                        <div class="col-lg-8">
                            <label for="">Are you and any of your proposed family members currently in good health, free from any illness or disease and not undergoing any medical treatment or surgery?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="medical_health_status" value="Yes">
                                <label class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="medical_health_status" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>
                    
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success float-end" id="submit">Save Changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="float-end d-none d-md-block">
                <button type="button" class="btn btn-success float-end me-2 mb-3" id="edit_row" data-bs-toggle="modal" data-bs-target="#myModal">
                    <i class="ti-plus"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row proposed_edit">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title">Healths Information</h5>
                </div>
                <div class="card-body">
                    <div class="col-12 float-end">
                        <div class="form-group">
                            <label for="" class="mt-4">If No please provide details:</label>
                            <table id="proposed_family_members" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Family Member</th>
                                        <th>Illness/Injury</th>
                                        <th>Hospital</th>
                                        <th>Duration</th>
                                        <th>Present Condition</th>
                                        <th>
                                            <button type="button" class="btn btn-tool">
                                            <i class="ti-plus"></i>
                                        </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Family Member</th>
                                        <th>Illness/Injury</th>
                                        <th>Hospital</th>
                                        <th>Duration</th>
                                        <th>Present Condition</th>
                                        <th>
                                            <button type="button" class="btn btn-tool">
                                                <i class="ti-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('eternity-plus.medicals.add-health-info')
@include('eternity-plus.medicals.edit-health-info')
@endsection
@push('dataTablesjs')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#proposed_family_members").DataTable({
                processing:true,
                info:true,
                ajax:location.protocol + '//' + location.hostname + ":8000/all-health-info/" + {{ Request::segment(3) }},
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"fullname", name:"fullname"},
                    {data:"illness_injury", name:"Illness / Injury"},
                    {data:'hospital',name:'Hospital'},
                    {data:'duration',name:'Duration'},
                    {data:'present_condition',name:'Medical Status'},
                    {data:'actions',name:"actions",orderable:false,searchable:false}
                ]
            }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
        });
    </script>
@endpush
@push('eternityPlusJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/flatpickr/js/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }} "></script>
    <script src="{{ asset('assets/js/proposed_family.js') }}"></script>

    <script>
        $(function(){
            $('#edit-medicals-form').on('submit',function(e){
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
        function deleteFam(id) {
            $.ajax({
                url:
                    location.protocol +
                    "//" +
                    location.hostname +
                    ":8000/delete-health-info",
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
                        $('#proposed_family_members').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes

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
                            title: "   Cannot drop health information",
                        });
                    }
                }, // /success
            }); // /aj
        }

                // Update data 
        $(document).on('click','#editHealthBtn', function(){
            var med_id = $(this).data('id');
            $('.editHealthForm').find('form')[0].reset();
            $('.editHealthForm').find('span.error-text').text('');

            $.post('<?= route("get.health.info"); ?>',{med_id:med_id},function(data){
                console.log(data.details)
                $('.editHealthForm').find('input[name="health_id"]').val(data.details.id);
                $('.editHealthForm').find('input[name="eFirstname"]').val(data.details.firstname);
                $('.editHealthForm').find('input[name="eSurname"]').val(data.details.surname);
                $('.editHealthForm').find('input[name="duration"]').val(data.details.duration);
                $('.editHealthForm').find('input[name="eIllness_injury"]').val(data.details.illness_injury);
                $('.editHealthForm').find('input[name="eHospital"]').val(data.details.hospital);
                $('.editHealthForm').find('input[name="ePresent_condition"]').val(data.details.present_condition);
                $('.editHealthForm').modal('show');

            },'json');
        })
        
    </script>
@endpush