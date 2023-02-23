<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Customer;
use App\Models\eternity_options;
use App\Models\application;
use App\Models\beneficiary;
use App\Models\debit_order;
use App\Models\family_member;
use App\Models\health_info;
use App\Models\intermediary;
use App\Models\medical_info;
use App\Models\premium_payer;
use App\Models\premium_payment;
use App\Models\trustee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EternityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('eternity-plus.manage-eternity');
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
        return view('eternity-plus.create-eternity', ['countries' => $countries]);
    }

    public function allEternityApplications()
    {
        $eternity_ = application::all();

        return DataTables::of($eternity_)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at'])->diffForHumans();
            })
            ->addColumn('fullname', function ($rows) {
                return $rows->customer->surname . ', ' . $rows->customer->firstname;
            })
            ->addColumn('assigned', function ($rows) {
                return $rows->user->lastname . ', ' . $rows->user->firstname;
            })
            ->addColumn('status', function ($rows) {
                if ($rows['status'] === 1) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-success">Approved</a>';
                } elseif ($rows['status'] === 0) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-danger">Pending Approval: Hub</a>';
                } else {
                    return  '<a class="badge rounded-pill bg-danger">N/A</a>';
                }
            })
            ->addColumn('actions', function ($rows) {
                return '
                    <a class="btn btn-success btn-sm" href="eternity-plus/edit-policy/' . $rows['id'] . '"><i class="fas fa-pen-square"></i></a>   
                    <a class="btn btn-danger btn-sm" data-id="' . $rows['id'] . '" id="deleteUserBtn"><i class="ti-trash"></i></a>   
                    <a class="btn btn-primary btn-sm" data-id="' . $rows['id'] . '" id="pwdResetBtn"><i class="ti-key"></i></a>   
                ';
            })
            ->rawColumns(['actions', 'fullname', 'status', 'created_at', 'assigned'])
            ->make(true);
    }

    public function getOptionalBenefitValue(Request $request)
    {
        $age    = $request->newage;
        $relationship = $request->relationship;
        $benefit =  $request->benefit;
        $query = eternity_options::where('Age', $age)
            ->where('Relationship', $relationship)
            ->where('Option', $benefit)->get();

        if ($query) {
            return response()->json(['code' => 1, 'details' => $query]);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }



    public function getStandardBenefitValue(Request $request)
    {
        $age    = $request->newage;
        $relationship = $request->relationship;
        $benefit =  $request->benefit_id;
        $query = eternity_options::where('Age', $age)
            ->where('Relationship', $relationship)
            ->where('Option', $benefit)->get();

        if ($query) {
            return response()->json(['code' => 1, 'details' => $query]);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            "id_number" => "required|string",
            'existing_policy' => 'required',
            'existing_policy_number' => 'required|string',
            'medical_health_status' => 'required',
            "subagent_name"   => "required|string",
            "subagent_code"   => "required",
            "branch"        => "required|string",
            "ist_premium_date" => "required|date",
            "champion_signature" => "required",
            "premium_tin" => "required",
            "premium_email" => "required|email",
            "premium_mobile_number" => "required",
            "premium_birthdate" => "required|date",
            "premium_firstname" => "required",
            "premium_surname" => "required",
            "premium_title"  => "required",
            "account_holder" => "required|string",
            "account_number" => "required|numeric|digits_between:11,11",
            "bank_branch"    => "required",
            "branch_name"    => "required",
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
        } else {
            return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
        }



        /**
         * Store in application tbl 
         * retrieve the application ID for reference for other tables
         */
        $application = new application();
        $application->policy_number = "METFNBGHFEP" . microtime(true);
        $application->status = 0;
        $application->proposed_sum = 0.0;
        $application->monthly_risk_premium = 0.0;
        $application->user_id = Auth::user()->id;
        $application->customer_id = $customer_id;



        if ($application->save()) {
            $application_id = $application->id;
        } else {
            return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
        }


        /**
         * Store in family members Table
         */
        for ($i = 0; $i < count($request->fullname); $i++) {

            $family_member  = new family_member();

            //get firstname and lastname => fullname 
            $names = explode(" ", $request->fullname[$i]);
            $firstname_of_member = $names[0];
            $surname_of_member  = $names[1];

            $family_member->firstname    = $firstname_of_member;
            $family_member->surname      = $surname_of_member;
            $family_member->gender       = $request->gender_of_member[$i];
            $family_member->birthdate    = $request->birthdate_of_member[$i];
            $family_member->relationship = $request->relationship_of_member[$i];
            $family_member->standard_premium     = $request->standard_premium[$i];
            $family_member->optional_premium     = $request->optional_premium[$i];
            $family_member->optional_benefit = $request->optional_benefits[$i];
            $family_member->application_id = $application_id;

            if (!$family_member->save()) {
                return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
            }
        }

        /** Update application table with monthly_risk_premium and proposed_sum data */
        /** Reasons for doing this: prevent having one application have the same fields with same data for family_members*/
        $query = application::find($application_id)->update([
            'proposed_sum' => $request->benefits,
            'monthly_risk_premium' => $request->monthly_premium
        ]);

        if ($query === false) {
            return response()->json(['code' => 0, 'msg' => 'failed to update necessary field(s)']);
        }

        /** Medical Information */
        $medicals = new medical_info();
        $medicals->existing_policy = $request->existing_policy;
        $medicals->existing_policy_number = !empty($request->existing_policy_number) ? $request->existing_policy_number : 'n/a';
        $medicals->life_insurance_status = $request->existing_life_insurance;
        $medicals->refusal_reasons = !empty($request->refusal) ? $request->refusal : 'n/a';
        $medicals->medical_health_status = $request->medical_health_status;
        $medicals->application_id = $application_id;

        if (!$medicals->save()) {
            return response()->json(['code' => 0, 'msg' => 'Error']);
        }

        /** Add data of members who had previous health conditions. If */
        if (!empty($request->proposed_family_member)) {
            for ($i = 0; $i < count($request->proposed_family_member); $i++) {

                $names = explode(" ", $request->proposed_family_member[$i]);
                $surname = $names[0];
                $firstname = $names[1];

                $health_info = new health_info();
                $health_info->surname = $surname;
                $health_info->firstname = $firstname;
                $health_info->illness_injury = $request->illness_injury[$i];
                $health_info->hospital = $request->hospital[$i];
                $health_info->duration = $request->duration[$i];
                $health_info->present_condition = $request->present_condition[$i];
                $health_info->application_id = $application_id;

                if (!$health_info->save()) {
                    return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
                }
            }
        }

        /**
         * Store data in Beneficiaries Table
         */
        for ($i = 0; $i < count($request->beneficiary_name); $i++) {

            $names = explode(" ", $request->beneficiary_name[$i]);
            $surname = $names[0];
            $firstname = $names[1];

            $beneficiary = new beneficiary();
            $beneficiary->surname = $surname;
            $beneficiary->firstname = $firstname;
            $beneficiary->beneficiary_gender = $request->beneficiary_gender[$i];
            $beneficiary->beneficiary_date = $request->beneficiary_date[$i];
            $beneficiary->beneficiary_relationship = $request->beneficiary_relationship[$i];
            $beneficiary->benefit_percentage = $request->beneficiary_benefit[$i];
            $beneficiary->beneficiary_contact = $request->beneficiary_contact[$i];
            $beneficiary->application_id = $application_id;

            if (!$beneficiary->save()) {
                return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
            }
        }

        /** Trustee */
        if (!empty($request->trustee_name)) {

            $trustee = new trustee();
            $names = explode(" ", $request->trustee_name);
            $surname = $names[0];
            $firstname = $names[1];
            $trustee->surname = $surname;
            $trustee->firstname = $firstname;
            $trustee->trustee_gender = $request->trustee_gender;
            $trustee->trustee_birthdate = $request->trustee_birthdate;
            $trustee->trustee_relationship = $request->trustee_relationship;
            $trustee->trustee_address  = $request->trustee_address;
            $trustee->trustee_contact  = $request->trustee_contact;
            $trustee->application_id = $application_id;

            if (!$trustee->save()) {
                return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
            }
        }


        $query = application::find($application_id)->update([
            'signature_date' => $request->declarant_date
        ]);


        if ($query === false) {
            return response()->json(['code' => 0, 'msg' => 'failed to update necessary field(s)']);
        }

        /**
         * Store data in Intermediary Table 
         */

        $intermediary  = new intermediary();

        $intermediary->user_id = Auth::user()->id;
        $intermediary->subagent_code = $request->subagent_code;
        $intermediary->date_to_deduction = $request->subagent_deduction_date;
        $intermediary->application_id = $application_id;

        if (!$intermediary->save()) {
            return response()->json(['code' => 0, 'msg' => 'Trace: intermediaries data has error']);
        }


        /**
         *  Premium Payer
         */


        $premium_payer = new premium_payer();

        $premium_payer->premium_title = $request->premium_title;
        $premium_payer->premium_firstname = $request->premium_firstname;
        $premium_payer->premium_surname   = $request->premium_surname;
        $premium_payer->premium_birthdate = $request->premium_birthdate;
        $premium_payer->premium_mobile_number = $request->premium_mobile_number;
        $premium_payer->premium_tin_number     = $request->premium_tin;
        $premium_payer->premium_email   = $request->premium_email;
        $premium_payer->application_id = $application_id;
        $premium_payer->user_id = Auth::user()->id;

        if ($premium_payer->save()) {
            $premium_payer_id =  $premium_payer->id;
        } else {
            return response()->json(['code' => 0, 'msg' => 'System error encountered, contact System Admin']);
        }


        /**
         * Premium Payment
         */
        $payment = new premium_payment();

        $payment->premium_risk = $request->premium_risk;
        $payment->premium_savings  = $request->premium_savings;
        $payment->premium_fee       = $request->premium_fee;
        $payment->premium_total    = $request->premium_total;
        $payment->premium_frequency = $request->premium_frequency;
        $payment->premium_mode      = $request->premium_mode;
        $payment->premium_increase   = $request->premium_increase;
        $payment->premium_deduction = $request->premium_deduction;
        $payment->application_id   = $application_id;
        $payment->premium_payer_id = $premium_payer_id;
        $payment->user_id = Auth::user()->id;


        if (!$payment->save()) {
            return response()->json(['code' => 0, 'msg' => 'System error encountered, please contact system administrator']);
        }


        /***
         * Debit Order
         */

        $debit_order = new debit_order(); // next updates should have debit_deduction name as model name
        $names = explode(" ", $request->account_holder);
        $surname = $names[0];
        $firstname = $names[1];
        $debit_order->debit_order_surname   = $surname;
        $debit_order->debit_order_firstname = $firstname;
        $debit_order->bank_name = $request->bank_name;
        $debit_order->bank_branch = $request->bank_branch;
        $debit_order->account_number = $request->account_number;
        $debit_order->account_type   = $request->account_type;
        $debit_order->application_id = $application_id;
        $debit_order->user_id = Auth::user()->id;

        if (!$debit_order->save()) {
            return response()->json(['code' => 0, 'msg' => 'System error encountered, please contact system administrator']);
        }


        return response()->json(['code' => 1, 'msg' => 'Success']);
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
        $countries = Country::all();
        $apps = application::find($id);
        $customer = Customer::find($id);
        $user = User::where('id', $apps->user_id)->with('intermediary')->get();
        $members = family_member::where('application_id', $apps->id)->get();
        $medicals = medical_info::where('application_id', $apps->id)->get();
        $healths = health_info::where('application_id', $apps->id)->get();
        $beneficiaries = beneficiary::where('application_id', $apps->id)->get();
        $premium_payer = premium_payer::where('application_id', $apps->id)->get();
        $premium_payment = premium_payment::where('application_id', $apps->id)->get();
        $debit_order = debit_order::where('application_id', $apps->id)->get();
        $intermediary = intermediary::where('application_id', $apps->id)->get();


        return view(
            'eternity-plus.edit-eternity',
            [
                'countries' => $countries,
                'apps' => $apps,
                'customer' => $customer,
                'members' => $members,
                'medical_info' => $medicals,
                'health_info' => $healths,
                'beneficiaries' => $beneficiaries,
                'premium_payer' => $premium_payer,
                'payment' => $premium_payment,
                'debit_info' => $debit_order,
                'intermInfo' => $intermediary,
                'user' => $user
            ]

        );
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
}
