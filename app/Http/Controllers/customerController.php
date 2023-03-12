<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Country;
use App\Models\Customer;
use App\Models\family_member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('customers.manage-customers', ['countries' => Country::all()]);
    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            "title" => "required",
            "surname" => "required|string",
            "firstname" => "requried|string",
            "birthdate" => "required|date",
            "birthplace"  => "required|string",
            "gender"     => "required|string",
            "occupation" => "required|string",
            "marital_status" => "required|string",
            "nationality"   => "required|string",
            "phone_number"  => "required|string",
            "email"         => "required|email",
            "postal_address" => "required|string",
            "tin_number"    => "required|string|max:15|min:10",
            "form_of_identification"      => "required|string",
            "id_number" => "required|string"
        ]);

        if ($validate) {

            $customer = new Customer();
            $customer->title = $request->title;
            $customer->surname = $request->surname;
            $customer->firstname = $request->firstname;
            $customer->birthdate = $request->birthdate;
            $customer->birthplace  = $request->birthplace;
            $customer->gender   = $request->gender;
            $customer->occupation = $request->occupation;
            $customer->marital_status = $request->marital_status;
            $customer->nationality  = $request->nationality;
            $customer->phone_number = $request->phone_number;
            $customer->email = $request->email_address;
            $customer->home_address = $request->home_address;
            $customer->postal_address = $request->postal_address;
            $customer->tin_number = $request->tin_number;
            $customer->id_number  = $request->identity_number;
            $customer->form_of_identification = $request->form_of_identification;
            $customer->upload_document = 1;
            $customer->user_id = Auth::user()->id;

            if ($customer->save()) {
                $customer_id = $customer->save();
            } else {
                return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
            }


            // Initialize the application 
            $application = new application();
            $application->policy_number = "METFNBGHFEP" . microtime(true);
            $application->status = 0;
            $application->proposed_sum = 0.0;
            $application->monthly_risk_premium = 0.0;
            $application->user_id = Auth::user()->id;
            $application->customer_id = $customer_id;

            if (!$application->save()) {
                return response()->json(['code' => 0, 'msg' => 'failed to create appplication']);
            }

            return response()->json(['code' => 0, 'msg' => 'Application Initialized']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'One or more fields are required']);
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
        //
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
        $customer = Customer::find($id);
        $countries = Country::all();
        return view('customers.edit', ['customer' => $customer, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $customerUpdate = Customer::find($id)->update([
            'title' => $request->title,
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'gender' => $request->gender,
            'birthdate' => $request->birthdate,
            'birthplace' => $request->birthplace,
            'nationality' => $request->nationality,
            'occupation' => $request->occupation,
            'home_address' => $request->home_address,
            'marital_status' => $request->marital_status,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'tin_number' => $request->tin_number,
            'form_of_identification' => $request->form_of_identification,
            'id_number' => $request->identity_number,
            'user_id' => Auth::user()->id
        ]);

        if (!$customerUpdate) {
            return response()->json(['code' => 0, 'msg' => 'Customer update failed']);
        }

        return response()->json(['code' => 1, 'msg' => 'Customer update Successful']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function planDetails($id)
    {
        $application = application::where('id', $id)->first();
        return view('customers.manage-plan-details', ['application' => $application]);
    }
}
