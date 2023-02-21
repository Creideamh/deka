@extends('layouts.app-layout')

@section('title','User Profile')
    
@section('content')
    <!-- start page title -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h6 class="page-title">Profile</h6>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="#">Deka</a></li>
                    <li class="breadcrumb-item"><a href="#">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title --> 

    <div class="row">
        <div class="col-xl-3">
            <div class="user-sidebar">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex justify-content-end">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle text-muted fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="mt-n4 position-relative">
                            <div class="text-center">
                                <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-xl rounded-circle img-thumbnail">

                                <div class="mt-3">
                                    <h5 class="">{{ Auth::user()->firstname }} {{ Auth::user()->lastname}}</h5>
                                    <div>
                                        <a href="#" class="text-muted m-1">{{ Auth::user()->jobTitle}}</a>
                                    </div>

                                    <div class="mt-4">
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm">Send Message</a>
                                        <a href="" class="btn btn-primary waves-effect waves-light btn-sm">Email</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="p-3 mt-3">
                            <div class="row text-center">
                                <div class="col-6 border-end">
                                    <div class="p-1">
                                        <h5 class="mb-1">1,269</h5>
                                        <p class="text-muted mb-0">Products</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-1">
                                        <h5 class="mb-1">5.2k</h5>
                                        <p class="text-muted mb-0">Followers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Demographics</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Gender</span><span>{{  Auth::user()->gender }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">DOB</span><span>{{ Auth::user()->birthdate }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Country</span><span>{{ Auth::user()->country }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Cellphone</span><span>{{ Auth::user()->cellphone }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">@Email</span><span>{{ Auth::user()->email }}</span></li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Status</span>
                                @php
                                    if (Auth::user()->status == 1)
                                        echo '<span class="badge bg-success">active</span>';
                                    else 
                                        echo '<span class="badge bg-danger">disabled</span>';
                                @endphp
                            </li>
                            <li class="d-flex justify-content-between p-2 font-size-15"><span class="text-muted">Position</span><span>{{ Auth::user()->jobTitle }}</span></li>
                        </ul>
                    </div> <!-- end card body -->
                </div> <!-- end card -->

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-primary bg-gradient fs-4">
                                        <i class="mdi mdi-chart-pie"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Revenue</p>
                                <h5 class="mb-0">$21,456</h5>
                            </div>

                            <div class="flex-shrink-0 align-self-end ms-2">
                                <div class="badge rounded-pill font-size-13 badge-soft-success">+ 2.65%
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->


                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-primary bg-gradient fs-4">
                                        <i class="mdi mdi-shopping"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Orders</p>
                                <h5 class="mb-0">5,643</h5>
                            </div>
                            <div class="flex-shrink-0 align-self-end ms-2">
                                <div class="badge rounded-pill font-size-13 badge-soft-danger">- 0.82%
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->


                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-primary bg-gradient fs-4">
                                        <i class="mdi mdi-account-multiple"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <p class="text-muted mb-1">Customers</p>
                                <h5 class="mb-0">45,254</h5>
                            </div>
                            <div class="flex-shrink-0 align-self-end ms-2">
                                <div class="badge rounded-pill font-size-13 badge-soft-danger">- 1.04%</div>
                            </div>
                        </div>
                    </div> <!-- end card body -->
                </div> <!-- end card -->


            </div>
        </div>

        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div id="profile-chart" class="apex-charts"></div>
                </div>
            </div>

            @if (session('errors'))
                <div class="alert alert-danger bg-danger text-white">{{ session('errors')}}</div>
            @elseif (session('success'))
                <div class="alert alert-danger bg-success text-white">Got it, password changed</div>
            @endif
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#about" role="tab">
                            <i class="bx bx-user-circle font-size-20"></i>
                            <span class="d-none d-sm-block">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#tasks" role="tab">
                            <i class="bx bx-clipboard font-size-20"></i>
                            <span class="d-none d-sm-block">Change Password</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab content -->
                <div class="tab-content p-4">

                    <div class="tab-pane" id="about" role="tabpanel">
                        <div>
                            <form action="" method="post">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Firstname</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="firstname" value="{{ Auth::user()->firstname }}" disabled placeholder="" id="firstname">
                                    </div>
                                </div>
    
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Lastname</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="lastname" value="{{ Auth::user()->lastname }}" disabled placeholder="" id="lastname">
                                    </div>
                                </div> 

                                <div class="row mb-3">
                                    <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Birthdate</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="birthdate" value="{{ Auth::user()->birthdate }}" disabled id="birthdate">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="gender" aria-label="Default select example" disabled>
                                            <option selected="">----------------</option>
                                            <option selected>{{ Auth::user()->gender }}</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="country" aria-label="Default select example" disabled>
                                            <option>----------------</option>
                                            <option value="" selected>{{ Auth::user()->country }}</option>
                                            @forelse ($countries as $country)
                                                <option value="{{ $country->name }}">{{ $country->name }} - {{ $country->code }}</option>
                                            @empty
                                                
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-tel-input" class="col-sm-2 col-form-label">Cellphone</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="tel" name="cellphone" value="{{ Auth::user()->cellphone }}" disabled placeholder="1-(555)-555-5555" id="example-tel-input">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}" disabled placeholder="bootstrap@example.com" id="example-email-input">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Job Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  type="text" name="jobTitle" value="{{ Auth::user()->jobTitle }}" disabled placeholder="" id="firstname">
                                    </div>
                                </div>

                            </form>


                        </div>
                    </div>

                    <div class="tab-pane {{ session('errors') ? 'active' : ''}}"  id="tasks" role="tabpanel">
                        <div>
                            <form action="{{ route('auth.change.password') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="mt-3">
                                    <label>Current Password</label>
                                        <input type="password" maxlength="25" name="current_password"  class="form-control" id="thresholdconfig">
                                        @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mt-3">
                                    <label>New Password</label>
                                        <input type="password" maxlength="25" name="new_password" class="form-control" id="thresholdconfig">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="mt-3">
                                    <label>Confirm Password</label>
                                        <input type="password" maxlength="25" name="password_confirm" class="form-control" id="thresholdconfig">
                                        @error('password_confirm')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success float-end">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="p-4 pb-0">
                    <h5 class="card-title mb-0">Team Members</h5>
                </div>
                <!-- Future feature, display team members -->
                
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <table class="table align-middle table-nowrap mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 50px;"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle avatar-sm" alt=""></td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Daniel Canales</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-13">Frontend</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-sm" alt=""></td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Jennifer Walker</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-13">UI / UX</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                C
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Carl Mackay</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-13">Backend</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/avatar-4.jpg" class="rounded-circle avatar-sm" alt=""></td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Janice Cole</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-13">Frontend</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="avatar-sm">
                                            <span class="avatar-title rounded-circle bg-primary text-white font-size-14">
                                                T
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="font-size-14 m-0"><a href="javascript: void(0);" class="text-dark">Tony Brafford</a></h5>
                                    </td>
                                    <td>
                                        <div>
                                            <a href="javascript: void(0);" class="badge bg-soft-primary text-primary font-size-13">Backend</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>

            </div> <!-- end card -->
        </div>
    </div>
    <!--end row-->
@endsection