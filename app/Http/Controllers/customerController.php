<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\Country;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return view('customers.manage-customers', ['countres' => Country::all()]);
    }

    public function getCustomers()
    {
        $customers_ = Customer::all();

        return DataTables::of($customers_)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $row['created_at'])->diffForHumans();
            })
            ->addColumn('fullname', function ($rows) {
                return $rows->surname . ', ' . $rows->firstname;
            })
            ->addColumn('assigned', function ($rows) {
                return $rows->user->lastname . ', ' . $rows->user->firstname;
            })
            ->addColumn('status', function ($rows) {
                if ($rows->application->status == 1) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-success">Active</a>';
                } elseif ($rows->application->status == 0) {
                    return  '<a data-id="' . $rows['id'] . '" class="badge rounded-pill bg-danger">Pending</a>';
                } else {
                    return  '<a class="badge rounded-pill bg-danger">N/A</a>';
                }
            })
            ->addColumn('actions', function ($rows) {
                return '
                    <a class="btn btn-success btn-sm" href="eternity-plus/edit-policy/' . $rows['id'] . '"><i class="fas fa-pen-square"></i></a>   
                    <a class="btn btn-danger href="eternity-plus/delete-policy/' . $rows['id'] . '" btn-sm" data-id="' . $rows['id'] . '" id="deletePolicyBtn"><i class="ti-trash"></i></a>   
                    <a class="btn btn-primary btn-sm" data-id="' . $rows['id'] . '" id="pwdResetBtn"><i class="ti-key"></i></a>   
                ';
            })
            ->rawColumns(['actions', 'fullname', 'status', 'created_at', 'assigned'])
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
        //
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
