<!-- sample modal content -->
<div>
    <div id="myEditModal" class="modal fade editHealthForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Edit Member Health Information 
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit.health.info')}}" id="edit-health-form" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                            <input type="hidden" name="health_id">
                            <input type="hidden" name="duration" id="duration">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Surname</label>
                                    <input type="text" name="eSurname" id="eSurname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Firstname</label>
                                    <input type="text" name="eFirstname" id="eFirstname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Illness / Injury </label>
                                    <input type="text" class="form-control" id="eIllness_injury"  name="eIllness_injury">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Hospital</label>
                                    <input type="text" class="form-control" id="eHospital"  name="eHospital">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">----------------------------------------------------------------------------------------Duration-</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Start</label>
                                    <input type="text" class="form-control" id="startDate"  name="eStartDate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">End</label>
                                    <input type="text" class="form-control" id="endDate"  name="eEndDate">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="">Present Condition</label>
                                    <input type="text" name="ePresent_condition" class="form-control" id="ePresent_condition" />
                                </div>
                            </div>
                        </div>
                </div>
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
        $(function(){
            $('#edit-health-form').on('eSubmit',function(e){
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
                            $('#proposed_family_members').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('.editHealthForm').find('form')[0].reset(); // resets form fields
                            $('#myEditModal').modal('hide'); // hide modal
                        }
                        
                    }
                })
            })
        })
    </script>
@endpush