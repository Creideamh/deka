@extends('layouts.app-layout')

@section('title', 'Eternity Plus')

@push('toastrCss')
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.css" integrity="sha512-SWjZLElR5l3FxoO9Bt9Dy3plCWlBi1Mc9/OlojDPwryZxO0ydpZgvXMLhV6jdEyULGNWjKgZWiX/AMzIvZ4JuA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h6 class="page-title"><i class="ti-medall"></i>&nbsp; Eternity Plus</h6>
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
                        <a class="dropdown-item" href="{{ route('create.plus') }}">Create Eternity Plus</a>
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

                <h4 class="card-title">EPlus Table</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                    <thead>
                        <tr>
                            <th>#Application</th>
                            <th>Owner</th>
                            <th>Created By</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($eternity_ as $item => $value)
                            <tr class="context-menu-one" data-id="{{ $value['id'] }}">
                                <td>
                                    <img src="{{ asset('assets/images/285644_folder_green_icon_48.png')}}" width="24" height="24" alt=""> &nbsp; {{ $value['policy_number'] }}
                                </td>
                                <td>{{ $value->customer->surname}}, {{ $value->customer->firstname }}</td>
                                <td>{{ $value->user->lastname }}, {{ $value->user->firstname }}</td>
                                <td>
                                    @if ($value['status'] == 1)
                                        <span class="badge rounded-pill text-bg-success">Active</span>
                                    @elseif ($value['status'] == 0 )
                                        <span class="badge rounded-pill text-bg-danger">Pending</span>
                                    @endif

                                </td>
                                <td>{{ $value['updated_at'] }}</td>

                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection
@push('toastrJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.js" integrity="sha512-kvg/Lknti7OoAw0GqMBP8B+7cGHvp4M9O9V6nAYG91FZVDMW3Xkkq5qrdMhrXiawahqU7IZ5CNsY/wWy1PpGTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.ui.position.min.js" integrity="sha512-878jmOO2JNhN+hi1+jVWRBv1yNB7sVFanp2gA1bG++XFKNj4camtC1IyNi/VQEhM2tIbne9tpXD4xaPC4i4Wtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            })
        });
        $(function() {
        $.contextMenu({
            selector: 'tr', 
            callback: function(key, options) {
                var link = key+"/edit/"+$(this).data('id');
                var m = "clicked: " + $(this).data('id');
                window.location.href=link;
            },
            items: {
                "customer": {name: "Customer", icon: "fas fa-user"},
                "plan-details": {name: "Plan Details", icon: "fas fa-users"},
               medicals: {name: "Medicals", icon: "fas fa-hospital-user"},
                "beneficiaries": {name: "Beneficiaries", icon: "paste"},
                "Health": {name: "Health Info", icon: "fas fa-hospital-symbol"},
                "declarations": {name: "declarations", icon: "fas fa-signature"},
                "premium-payment": {name: "Premium Payment", icon: "fas fa-money-check"},
                "debits": {name: "Debits", icon: "fas fa-money-bill-wave"},
                "preview": {name: "Preview", icon: "far fa-eye"},

                "sep1": "---------",
                "quit": {name: "Quit", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });

        $('.context-menu-one').on('click', function(e){
            console.log('clicked', this);
        })    
    });
    </script>
    <script>
    $(document).on('click','#deletePolicyBtn',function(){
            var id = $(this).data('id');
            var url = '<?= route("delete.plus") ;?>';

            // Sweet Alert to confirm deletion 
            swal.fire({
            title:'Are you sure?',
            html:"You want to <b>delete<b> this Policy",
            showCancelButton:true,
            showCloseButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, Delete',
            confirmButtonColor:'#556ee6',
            width:300,
            allowOutsideClick:false
            }).then(function(result){
                if(result.value){
                    $.post(url,{id:id},function(data){
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
            $('#add-permission-form').on('submit', function(e){
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
                        }else if(data.code === 1){
                            $('#datatable').DataTable().ajax.reload(null,false); // reloads DT, so not to refresh page to see changes
                            $('#modal-default').modal('hide');
                            toastr.success(data.msg);
                        }else{
                            toastr.error('System error, contact sysadmin');
                        }
                    }
                    })
             })
        })

        $(document).ready(function () {

            $('#edit-permission-form').on('submit',function(e){
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
                        $('.editPermission').find('form')[0].reset(); // resets form fields
                        $('.editPermission').modal('hide'); // hide modal
                        toastr.success(data.msg); 
                    }
                }
              })
            })

        })
    </script>
@endpush
