@extends('layouts.app-layout')

@section('title','Edit User')
    @push('toastrCss')
        <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.min.css') }}">
    @endpush

    @push('select2Css')
        <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    @endpush
@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h6 class="page-title"><i class="ti-user"></i>&nbsp; Edit User</h6>
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
    <div class="col-12 mb-2">
        @if (session('errors'))
        <div class="alert alert-danger bg-danger text-white mb-0 border-0">{{ session('errors') }}</div>
        @elseif (session('success'))
            <div class="alert alert-danger bg-success text-white mb-0 border-0">
                Well done! You successfully read this important alert message.
                <a href="{{ route('users.lists') }}">Click to Manage Users</a>
            </div>
        @endif
    </div>
    <div class="col-12">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add User</h5>

                <form action="{{ route('update.user') }}" method="POST" id="edit-user-form">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Firstname</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="firstname" value="{{ $user->firstname }}"   placeholder="" id="firstname">
                        </div>
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Lastname</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="lastname" value="{{ $user->lastname }}"  placeholder="" id="lastname">
                        </div>
                        @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> 

                    <div class="row mb-3">
                        <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-sm-10">
                            <input id="input-date1" class="form-control  input-mask" name="birthdate" value="{{ $user->birthdate }}" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="yyyy-mm-dd" im-insert="false">                        
                            @error('birthdate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="gender" aria-label="Default select example" >
                                    @php
                                        if( $user->gender === 'M'){
                                            echo '<option value="M" selected>Male</option>';
                                        }else{
                                            echo '<option value="F" selected>Female</option>';
                                        }
                                    @endphp
                                <option>----------------</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="country" aria-label="Default select example" >
                                <option value="{{ $user->country }}" selected>{{ $user->country }}</option>
                                <option>----------------</option>
                                @forelse ($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }} - {{ $country->code }}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                        </div>
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="example-tel-input" class="col-sm-2 col-form-label">Cellphone</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="tel" name="cellphone" value="{{ $user->cellphone }}"  placeholder="1-(555)-555-5555" id="example-tel-input">
                        </div>
                        @error('cellphone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name="email" value="{{ $user->email }}"   placeholder="bootstrap@example.com" id="example-email-input">
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Job Title</label>
                        <div class="col-sm-10">
                            <input class="form-control"  type="text" name="jobTitle" value="{{ $user->jobTitle }}"   placeholder="" id="jobTitle">
                        </div>
                        @error('jobTitle')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="status" aria-label="Default select example" >
                                @php
                                    if( $user->status === 1){
                                        echo '<option value="1" selected>Active</option>';
                                    }else{
                                        echo '<option value="0" selected>Disabled</option>';
                                    }
                                @endphp
                                <option>----------------</option>
                                <option value="1">Active</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="role" aria-label="Default select example" >
                                <option>----------------</option>
                            </select>
                        </div>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success float-end">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('toastrJs')
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
@endpush

@push('select2Js')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-mask.init.js') }}"></script>
    <script>
    $(document).on('click','$pwdResetBtn', function () {
        e.preventDefault();
        $.ajax({
                    url:"{{ route('reset.password') }}",
                    method:post,
                    data:new FormData(form),
                    processData:false,
                    dataType:'json',
                    contentType:false,
                    success:function(data){
                        if(data.code == 0){
                            toastr.error(data.msg); 
                        }else{
                            toastr.success(data.msg); 
                        }
                    }
                })


    })
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
        $(document).ready(function () {
            $('#edit-user-form').on('submit',function(e){
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
                        if(data.code == 0){
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