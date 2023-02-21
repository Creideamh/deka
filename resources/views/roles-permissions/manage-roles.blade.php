@extends('layouts.app-layout')

@section('title', 'Roles')

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

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title"><i class="ti-lock"></i>&nbsp; Roles</h6>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item active">Welcome, {{ Auth::user()->lastname }}</li>
            </ol>
        </div>
        <div class="col-md-4">
            <div class="float-end d-none d-md-block">
                <div class="dropdown">
                    <button class="btn btn-primary  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-cog me-2"></i> Settings
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Create Role</a>
                        <a class="dropdown-item" href="{{ route('roles.lists') }}">Manage Roles</a>
                        <a class="dropdown-item" href="#">Bulk Delete</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Roles Table</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>#Name</th>
                            <th>#Guard</th>
                            <th>Created_At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@include('roles-permissions.create-role')
@include('roles-permissions.edit-role')

@endsection
@push('toastrJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
@endpush
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
@endpush
@push('SweetAlert')
    <!-- SweetAlert 2 -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush
@push('userJs')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#datatable").DataTable({
                processing:true,
                info:true,
                ajax:location.protocol + '//' + location.hostname + ":8000/roles-lists",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"name", name:"Name"},
                    {data:'guard_name',name:'Guard'},
                    {data:'created_at',name:'Created_At'},
                    {data:'actions',name:"actions",orderable:false,searchable:false}
                ]
            }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
        });
    </script>
    <script>
    $(document).on('click','#deleteRoleBtn',function(){
            var role_id = $(this).data('id');
            var url = '<?= route("delete.role") ;?>';

            // Sweet Alert to confirm deletion 
            swal.fire({
            title:'Are you sure?',
            html:"You want to <b>delete<b> this Role",
            showCancelButton:true,
            showCloseButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, Delete',
            confirmButtonColor:'#556ee6',
            width:300,
            allowOutsideClick:false
            }).then(function(result){
                if(result.value){
                    $.post(url,{role_id:role_id},function(data){
                    if (data.code == 1) {
                        $('#datatable').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg)
                    }
                    },'json')
                }
            })

        }) 
    </script>
    <script>
        $(document).ready(function () {
            $('#add-role-form').on('submit', function(e){
                e.preventDefault();
                    $.ajax({
                    url:$(this).attr('action'),
                    method:$(this).attr('method'),
                    data:new FormData(this),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    beforeSend:function(){
                        $(document).find('span.error-text').text('');
                    },
                    success:function(data){
                        if(data.code == 0){
                            $.each(data.error, function(prefix,val){
                                $('span.'+prefix+'_error').text(val[0]);
                            });
                        }else{
                            $('#datatable').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('#modal-default').modal('hide');
                            toastr.success(data.msg);
                        }
                    }
                    })
             })
        })

        $(document).ready(function () {

            $('#edit-role-form').on('submit',function(e){
                e.preventDefault();
                var form = this;
                $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:new FormData(form),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.code === 0){
                        $.each(data.errors,function(prefix,val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        })
                    }else{
                        $('#datatable').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                        $('.editRole').find('form')[0].reset(); // resets form fields
                        $('.editRole').modal('hide'); // hide modal
                        toastr.success(data.msg); 
                    }
                }
              })
            })

        })

        // Update data 
        $(document).on('click','#editRoleBtn', function(){
            var role_id = $(this).data('id');
            $('.editRole').find('form')[0].reset();
            $('.editRole').find('span.error-text').text('');

            $.post('<?= route("role.details"); ?>',{role_id:role_id},function(data){
                $('.editRole').find('input[name="role_id"]').val(data.details.id);
                $('.editRole').find('input[name="name"]').val(data.details.name);
                $('.editRole').modal('show');
            },'json');
        })
    </script>
@endpush
