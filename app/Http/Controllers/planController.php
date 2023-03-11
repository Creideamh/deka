<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Customer;
use App\Models\eternity_options;
use App\Models\family_member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isNull;

class planController extends Controller
{

    public function edit($id)
    {
        $family = family_member::where('application_id', $id)->get();
        return view('eternity-plus.plan-details', ['family' => $family, 'application_id' => $id]);
    }

    //
    public function create_Plan_Details(Request $request)
    {
        // Validate form inputs
        $validate = Validator::make($request->all(), [
            'benefits' => 'required',
            'surname' => 'required|alpha',
            'firstname' => 'required|alpha',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'relationship' => 'required',
            'standard_premium' => 'required',
            'optional_premium' => 'required',
            'optional_benefit' => 'required'
        ]);

        if (!$validate) {
            return response()->json(['code' => 0, 'msg' => 'One or more input fields must be provided']);
        }

        // No duplicates are allowed
        $no_plan_duplicates = family_member::where('surname', '=', $request->surname)
            ->where('firstname', '=', $request->firstname)
            ->get();

        if (count($no_plan_duplicates) == 0) {
            // Insert data 
            $plan = new family_member();

            $plan->proposed_sum = $request->benefits;
            $plan->surname  = $request->surname;
            $plan->firstname = $request->firstname;
            $plan->birthdate = $request->birthdate;
            $plan->gender = $request->gender;
            $plan->relationship = $request->relationship;
            $plan->standard_premium = $request->standard_premium;
            $plan->optional_premium = $request->optional_premium;
            $plan->optional_benefit = $request->optional_benefit;
            $plan->monthly_risk_premium = $request->standard_premium + $request->optional_premium;
            $plan->application_id = $request->application_id;

            if (!$plan->save()) {
                return response()->json(['code' => 0, 'msg' => 'Please try again']);
            }

            return response()->json(['code' => 1, 'msg' => 'Success']);
        }

        return response()->json(['code' => 0, 'msg' => 'Duplicate entries found']);
    }
}
