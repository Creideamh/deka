<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Customer;
use App\Models\eternity_options;
use App\Models\family_member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

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


    public function get_Plan_Detail(Request $request)
    {
        $plan_id = family_member::find($request->plan_id);
        return response()->json(['details' => $plan_id]);
    }

    // Update member information
    public function updateMembers(Request $request)
    {
        $member = family_member::where('id', $request->plan_id)->update([
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'birthdate' => $request->eBirthdate,
            'gender' => $request->eGender,
            'relationship' => $request->eRelationship,
            'standard_premium' => $request->eStandard_premium,
            'optional_benefit' => $request->eOptional_benefit,
            'optional_premium' => $request->eOptional_premium,
            'proposed_sum' => $request->eBenefits,
            'monthly_risk_premium' => $request->eStandard_premium + $request->eOptional_premium
        ]);

        if ($member) {
            return response()->json(['code' => 1, 'msg' => 'Update successful']);
        } else if (!$member) {
            return response()->json(['code' => 0, 'msg' => 'Failed to update member data']);
        }

        return response()->json(['code' => 0, 'msg' => 'System error, please try again']);
    }

    /**
     * Get members of a plan
     */
    public function getMembers($id)
    {
        $members_ = family_member::where('application_id', '=', $id);

        return  DataTables::of($members_)
            ->addIndexColumn()
            ->addColumn('fullname', function ($rows) {
                return $rows->surname . ', ' . $rows->firstname;
            })
            ->addColumn('gender', function ($rows) {
                return $rows->gender;
            })
            ->addColumn('birthdate', function ($rows) {
                return $rows->birthdate;
            })
            ->addColumn('relationship', function ($rows) {
                return $rows->relationship;
            })
            ->addColumn('standard_premium', function ($rows) {
                return $rows->standard_premium;
            })
            ->addColumn('optional_benefit', function ($rows) {
                return $rows->optional_benefit;
            })
            ->addColumn('optional_premium', function ($rows) {
                return $rows->optional_premium;
            })
            ->addColumn('actions', function ($rows) {
                return '
                <a href="#" id="editPlanBtn" data-id="' . $rows->id . '"><span class="badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#myEditModal"><i class="far fa-edit"></i></span></a>
                <a href="#" onclick="deleteFam(' . $rows->id . ')"><span class="badge text-bg-danger"><i class="fas fa-trash"></i></span></a>
                ';
            })
            ->rawColumns(['actions', 'fullname'])
            ->make(true);
    }
}
