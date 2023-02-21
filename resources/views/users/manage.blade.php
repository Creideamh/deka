@extends('layouts.app-layout')

@section('title', 'Users')

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
            <h6 class="page-title"><i class="ti-user"></i>&nbsp; User</h6>
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
                        <a class="dropdown-item" href="{{ route('create.user') }}">Create User</a>
                        <a class="dropdown-item" href="{{ route('users.lists') }}">Manager Users</a>
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

                <h4 class="card-title">User Table</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>#Image</th>
                            <th>#ID</th>
                            <th>Fullname</th>
                            <th>@Email</th>
                            <th>Status</th>
                            {{-- <th>Role</th> --}}
                            <th>Created At</th>
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
@endpush
@push('userJs')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#datatable").DataTable({
                processing:true,
                info:true,
                ajax:location.protocol + '//' + location.hostname + ":8000/user-lists",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"userImage", name:"Image"},
                    {data:'id',name:'id'},
                    // DataTables  database initialization options
                    // {data:"DT_RowIndex",name:"DT_RowIndex"},
                    {data:'fullname',name:'fullname'},
                    {data:'email',name:'email'},
                    {data:'status',name:'Status'},
                    // {data:'role',name:'Role'},
                    {data:"created_at", name:"created_at"},
                    {data:'actions',name:"actions",orderable:false,searchable:false}
                ]
            }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
        });
    </script>
    <script>
    $(document).on('click','#deleteUserBtn',function(){
        var user_id = $(this).data('id');
        var url = '<?= route("delete.user") ;?>';

        // Sweet Alert to confirm deletion 
        swal.fire({
        title:'Are you sure?',
        html:"You want to <b>delete<b> this User",
        showCancelButton:true,
        showCloseButton:true,
        cancelButtonText:'Cancel',
        confirmButtonText:'Yes, Delete',
        confirmButtonColor:'#556ee6',
        width:300,
        allowOutsideClick:false
        }).then(function(result){
        if(result.value){
            $.post(url,{user_id:user_id},function(data){
            if (data.code == 0) {
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
@endpush
