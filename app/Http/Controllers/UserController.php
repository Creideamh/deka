<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.manage');
    }

    public function getAllUsers()
    {
        $users = User::where([
            ['status', '=', 1],
            ['id', '!=', Auth::user()->id]
        ])->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at'])->diffForHumans();
            })
            ->addColumn('userImage', function ($rows) {
                return '<img src="assets/images/users/' . $rows['userImage'] . '" class="rounded-circle" width="32" height="32" alt="">';
            })
            ->addColumn('fullname', function ($rows) {
                return $rows['lastname'] . ', ' . $rows['firstname'];
            })
            ->addColumn('email', function ($rows) {
                return $rows['email'];
            })
            ->addColumn('status', function ($rows) {
                if ($rows['status'] === 1) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-success">Active</a>';
                } elseif ($rows['status'] === 0) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-danger">Disabled</a>';
                }
            })
            ->addColumn('actions', function ($rows) {
                return '
                    <a class="btn btn-success btn-sm" href="users/edit-user/' . $rows['id'] . '"><i class="fas fa-pen-square"></i></a>   
                    <a class="btn btn-danger btn-sm" data-id="' . $rows['id'] . '" id="deleteUserBtn"><i class="ti-trash"></i></a>   
                    <a class="btn btn-primary btn-sm" data-id="' . $rows['id'] . '" id="pwdResetBtn"><i class="ti-key"></i></a>   
                ';
            })
            ->rawColumns(['actions', 'fullname', 'status', 'userImage'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::all();
        return view('users.create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = Validator::make($request->all(), [
            "firstname" => 'required|string|max:20',
            "lastname"  => 'required|string|max:25',
            "birthdate" => 'required',
            "gender"    => 'required',
            "country"   => 'required',
            "cellphone" => 'required',
            "email"     => 'required|email|unique:users',
            "JobTitle" => 'required|string',
            "status"    => 'required',
        ]);

        if ($validate->passes()) {
            return redirect('create-user')->withErrors('Ooh Snap!, Error occurred, try again');
        } else {

            /** MAKE AVATAR */
            $path = 'assets/images/users/';
            $fontPath = public_path('fonts/Oliciy.ttf');
            $fn = strtoupper($request->firstname[0]);
            $ln = strtoupper($request->lastname[0]);
            $char = strtoupper($ln . $fn); // get the name of user 
            $newAvatarName = rand(12, 34353) . time() . '_avatar.png';
            $dest = $path . $newAvatarName;

            $createAvatar = makeAvatar($fontPath, $dest, $char);
            $picture = $createAvatar == 'true' ? $newAvatarName : '';

            $user = new User();

            $user->firstname = $request->firstname;
            $user->lastname  = $request->lastname;
            $user->birthdate = $request->birthdate;
            $user->gender    = $request->gender;
            $user->country   = $request->country;
            $user->cellphone = $request->cellphone;
            $user->userImage   = $newAvatarName;
            $user->status    = $request->status;
            $user->email            = $request->email;
            $user->jobTitle        = $request->jobTitle;
            $user->password = Hash::make('P@$$w0rd');

            if ($user->save()) {
                return redirect('create-user')->withSuccess('Success');
            } else {
                return redirect('create-user')->back('500', 'System error, please try again or contact sysadmin');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $countries = Country::all();
        return view('users.edit', ['user' => $user, 'countries' => $countries]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $validate = Validator::make($request->all(), [
            "firstname" => 'required|string|max:20',
            "lastname"  => 'required|string|max:25',
            "birthdate" => 'required',
            "gender"    => 'required',
            "country"   => 'required',
            "cellphone" => 'required',
            "email"     => 'required', 'email', 'string', 'unique:users' . $request->user_id,
            "jobTitle" => 'required|string',
            "status"    => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 0, 'msg' => 'Error encountered, Please try again']);
        } else {
            $query = User::find($request->user_id)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'country' => $request->country,
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'jobTitle' => $request->jobTitle,
                'status' => $request->status,
            ]);

            if ($query) {
                return response()->json(["code" => 1, 'msg' => 'Updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Error encountered, Please try again']);
            }
        }
    }

    /***
     * Password reset
     */
    public function passwordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::Random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Email Verification Mail');
        });
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (Auth::user()->role > 1) {

            return response()->json(['code' => 1, 'msg' => 'Task Blocked, User does not right to perform task']);
        } else {

            $query = User::find($request->user_id)->update([
                'status' => 0
            ]);

            if ($query) {
                return response()->json(['code' => 0, 'msg' => 'Success']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Error encountered, Please try again']);
            }
        }
    }

    /**
     * User profile
     * 
     */
    public function userProfile()
    {
        $countries = Country::all();
        return view('users.user-profile', ['countries' => $countries]);
    }
}
