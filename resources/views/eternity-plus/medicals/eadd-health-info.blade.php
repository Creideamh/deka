<!-- sample modal content -->
<div id="myModal" class="modal fade addHealthForm" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Health Information 
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"     aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('add.health.info')}}" id="add-health-form" method="post">
                    <div class="row">
                        <input type="hidden" name="application_id" value="{{ Request::segment(3) }}">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Surname</label>
                                <input type="text" name="surname" id="surname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Firstname</label>
                                <input type="text" name="firstname" id="firstname" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Illness / Injury </label>
                                <input type="text" class="form-control" id="illness_injury"  name="illness_injury">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Hospital</label>
                                <input type="text" class="form-control" id="hospital"  name="hospital">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Duration</label>
                                <input type="text" class="form-control" id="duration"  name="duration">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="">Present Condition</label>
                                <input type="text" name="present_condition" class="form-control" id="present_condition" />
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
            $('#add-health-form').on('submit',function(e){
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
                            $('.addHealthForm').find('form')[0].reset(); // resets form fields
                            $('#myModal').modal('hide'); // hide modal
                        }
                    }
                })
            })
        })
    </script>
@endpush