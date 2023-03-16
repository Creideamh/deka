<?php

namespace App\Http\Controllers;

use App\Models\health_info;
use App\Models\medical_info;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class medicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $medical = medical_info::where('application_id', '=', $id)->get();
        $healthInfo = health_info::where('application_id', '=', $id)->get();
        return view('eternity-plus.medicals.edit', ['medicalInfo' => $medical, 'healthInfo' => $healthInfo]);
    }

    public function allHealthInfo($id)
    {
        $members_ = health_info::where('application_id', '=', $id);

        return  DataTables::of($members_)
            ->addIndexColumn()
            ->addColumn('fullname', function ($rows) {
                return $rows->surname . ', ' . $rows->firstname;
            })
            ->addColumn('illness_injury', function ($rows) {
                return $rows->illness_injury;
            })
            ->addColumn('hospitial', function ($rows) {
                return $rows->hospitial;
            })
            ->addColumn('duration', function ($rows) {
                return $rows->duration;
            })
            ->addColumn('present_condition', function ($rows) {
                return $rows->present_condition;
            })
            ->addColumn('actions', function ($rows) {
                return '
                <a href="#" id="editHealthBtn" data-id="' . $rows->id . '" data-bs-toggle="modal" data-bs-target="#myEditModal"><span class="badge text-bg-primary"><i class="far fa-edit"></i></span></a>
                <a href="#" onclick="deleteFam(' . $rows->id . ')"><span class="badge text-bg-danger"><i class="fas fa-trash"></i></span></a>
                ';
            })
            ->rawColumns(['actions', 'fullname'])
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
            "surname" => "required|string",
            "firstname" => "requried|string",
            "startDate" => "required|date",
            "endDate" => "required|date",
            "illness_injury"  => "required|string",
            "hospital"     => "required|string",
            "present_condition" => "required|string",
        ]);


        if (!$validate) {
            return response()->json(['code' => 0, 'msg' => 'One or more fields is required']);
        }

        /**
         * We could get in days 
         * but the supposed illness / injury is assumed to be more than a month
         */
        $startDate = Carbon::parse($request->startDate);
        $endDate = Carbon::parse($request->endDate);
        $months = $startDate->diffInMonths($endDate);

        if ($startDate > $endDate) {
            return response()->json(['code' => 0, 'msg' => 'Start Date cannot be greater than End Date']);
        }

        $healthData = new health_info();
        $healthData->surname = $request->surname;
        $healthData->firstname = $request->firstname;
        $healthData->illness_injury = $request->illness_injury;
        $healthData->hospital = $request->hospital;
        $healthData->duration = $months . ' months';
        $healthData->present_condition = $request->present_condition;
        $healthData->application_id = $request->application_id;

        if ($healthData->save()) {
            return response()->json(['code' => 1, 'msg' => 'Health information saved']);
        }

        return response()->json(['code' => 0, 'msg' => 'System error, please try again']);
    }

    public function healthInfo(Request $request)
    {
        $healthInfo = health_info::find($request->med_id);
        return response()->json(['details' => $healthInfo]);
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
     * Update Health Information of family members provided
     * by Policy Holder in
     * bad health conditions
     */
    public function update(Request $request)
    {

        // Enure no empty and invalid inputs
        $validate = Validator::make($request->all(), [
            "eSurname" => "required|string",
            "eFirstname" => "requried|string",
            "startDate" => "required|date",
            "endDate" => "required|date",
            "eIllness_injury"  => "required|string",
            "eHospital"     => "required|string",
            "ePresent_condition" => "required|string",
        ]);

        // If empty or invalid inputs
        if (!$validate) {
            return response()->json(['code' => 0, 'msg' => 'One or more fields is required']);
        }

        /**
         * We could get in days 
         * but the supposed illness / injury is assumed to be more than a month
         */

        $startDate = Carbon::parse($request->eStartDate);
        $endDate = Carbon::parse($request->eEndDate);
        $months = $startDate->diffInMonths($endDate);

        if ($startDate > $endDate) {
            return response()->json(['code' => 0, 'msg' => 'Start Date cannot be greater than End Date']);
        }

        // Update 
        $healthUpdate = health_info::find($request->health_id)->update([
            "surname" => $request->eSurname,
            "firstname" => $request->eFirstname,
            "duration" => $duration = empty($months) ? $request->duration : $months . ' months',
            "illness_injury"  => $request->eIllness_injury,
            "hospital"     => $request->eHospital,
            "present_condition" => $request->ePresent_condition,
        ]);

        if (!$healthUpdate) {
            return response()->json(['code' => 0, 'msg' => 'Failed to update health information']);
        }

        return response()->json(['code' => 1, 'msg' => 'Health Information update successful']);

        // return response()->json(['code' => 0, 'msg' => 'System error, Please try again or contact system administrator']);
    }


    // Update  Policy Holder's Medical Information 
    public function updateMedics(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            "existing_policy" => "required|string",
            "existing_policy_number" => "requried|string",
            "life_insurance_status" => "required|string",
            "refusal_reasons" => "required|date",
            "medical_health_status"  => "required|string",
        ]);

        if (!$validate) {
            return response()->json(['code' => 0, 'msg' => 'One or more fields is required']);
        }

        $med = medical_info::find($id)->update([
            'existing_policy' => $request->existing_policy,
            'existing_policy_number' => $policy_number = empty($request->existing_policy_number) ? 'n/a' : $request->existing_policy_number,
            'life_insurance_status' => $request->existing_life_insurance,
            'refusal_reasons' =>  $refusals =  empty($request->refusal_reasons) ? 'n/a' : $request->refusal_reasons,
            'medical_health_status' => $request->medical_health_status,
            'application_id' => $request->application_id
        ]);


        if ($med) {
            return response()->json(['code' => 1, 'msg' => 'Member medical health information Updated successfully']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Failed to update medical information']);
        }
        return response()->json(['code' => 0, 'msg' => 'System Error, Please try again or contact Sys Admin']);
    }


    /**
     * Delete Members in the Health list
     */
    public function deleteMember(Request $request)
    {
        $id = $request->member_id;
        $memberID  = health_info::find($id);


        if ($memberID->delete()) {
            return response()->json(['code' => 1, 'msg' => 'Member health information deleted successfully']);
        }

        return response()->json(['code' => 0, 'msg' => 'Failed to delete Member health information']);
    }
}
