@extends('layouts.app-layout')

@section('title', 'Eternity Plus')

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
            <h6 class="page-title"><i class="ti-medall"></i>&nbsp; Family Member</h6>
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
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#myModal">Create Customer</a>
                        <a class="dropdown-item" href="{{ route('eternity.lists') }}">Manage Eternity Plus</a>
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

                <h4 class="card-title">Family Members Table</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>N0#</th>
                            <th>Fullname</th>
                            <th>Gender</th>
                            <th>Birthdate</th>
                            <th>Relationship</th>
                            <th>Standard Premium</th>
                            <th>Optional Benefit</th>
                            <th>Optional Premium</th>
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
@include('customers.plan-details')
@push('toastrJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script>
        flatpickr("#birthdate", {
    dateFormat: "Y-m-d",
});

    </script>
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
@push('userJs')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#datatable").DataTable({
                processing:true,
                info:true,
                ajax:location.protocol + '//' + location.hostname + ":8000/all-members",
                "pageLength":5,
                "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                columns:[
                    {data:"id", name:"N0#"},
                    {data: "fullname", name: "Policy Holder"},
                    {data:'gender',name:'Gender'},
                    {data:'relationship',name:'Relationship'},
                    {data:'standard_premium',name:'Standard Premium'},
                    {data:'optional_benefit',name:'Optional Benefit'},
                    {data:'optional_premium',name:'Optional Premium'},
                    {data:'actions',name:"actions",orderable:false,searchable:false}
                ]
            }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
        });
    </script>
@endpush
