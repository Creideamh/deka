<?php

namespace App\Http\Controllers;

use App\Models\health_info;
use App\Models\medical_info;
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
            ->addColumn('existing_policy', function ($rows) {
                return $rows->existing_policy;
            })
            ->addColumn('policy_number', function ($rows) {
                return $rows->policy_number;
            })
            ->addColumn('insurance_status', function ($rows) {
                return $rows->life_insurance_status;
            })
            ->addColumn('refusals', function ($rows) {
                return $rows->refusal_reasons;
            })
            ->addColumn('medical_status', function ($rows) {
                if ($rows->medical_status === 'Yes') {
                    return '<a href="#"><span class="badge text-bg-success"></span></a>';
                } elseif ($rows->medical_status === 'No') {
                    return '<a href="#"><span class="badge text-bg-danger"></span></a>';
                }
            })
            ->addColumn('actions', function ($rows) {
                return '
                <a href="#" id="editMedicalBtn" data-id="' . $rows->id . '"><span class="badge text-bg-primary" data-bs-toggle="modal" data-bs-target="#myEditModal"><i class="far fa-edit"></i></span></a>
                <a href="#" onclick="deleteFam(' . $rows->id . ')"><span class="badge text-bg-danger"><i class="fas fa-trash"></i></span></a>
                ';
            })
            ->rawColumns(['actions', 'medical_status'])
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
            "duration" => "required|date",
            "illness_injury"  => "required|string",
            "hospital"     => "required|string",
            "present_condition" => "required|string",
        ]);


        if (!$validate) {
            return response()->json(['code' => 0, 'msg' => 'One or more fields is required']);
        }

        $healthData = new health_info();
        $healthData->surname = $request->surname;
        $healthData->firstname = $request->firstname;
        $healthData->illness_injury = $request->illness_injury;
        $healthData->hospital = $request->hospital;
        $healthData->duration = $request->duration;
        $healthData->present_condition = $request->present_condition;
        $healthData->application_id = $request->application_id;

        if ($healthData->save()) {
            return response()->json(['code' => 1, 'msg' => 'Health information saved']);
        }

        return response()->json(['code' => 0, 'msg' => 'System error, please try again']);
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
