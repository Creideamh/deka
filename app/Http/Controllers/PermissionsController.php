<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles-permissions.manage-permissions');
    }


    public function allPermissions()
    {
        $permissions = Permission::all();
        return DataTables::of($permissions)
            ->addIndexColumn()
            ->addColumn('created_at', function ($rows) {
                return Carbon::createFromFormat('Y-m-d H:i:s', $rows['created_at'])->diffForHumans();
            })
            ->addColumn('actions', function ($rows) {
                return '
                    <a class="btn btn-success btn-sm" data-id="' . $rows['id'] . '" id="editPermissionBtn" data-bs-toggle="modal" data-bs-target="#myEditModal"><i class="fas fa-pen-square"></i></a>   
                    <a class="btn btn-danger btn-sm" data-id="' . $rows['id'] . '" id="deletePermissionBtn"><i class="ti-trash"></i></a>   
                ';
            })
            ->rawColumns(['created_at', 'actions'])
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
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|alpha|unique:permissions'
        ]);

        if ($validate->passes()) {
            $query = Permission::create(['name' => $request->name]);
            if ($query) {
                return response()->json(['code' => 1, 'msg' => 'Success']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'Error encountered, please try again']);
            }
        } else {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPermissionDetails(Request $request)
    {
        $permission = Permission::findById($request->permission_id);
        return response()->json(['details' => $permission]);
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
            'name' => 'required|unique:permissions,name,' . $request->permission_id,
        ]);

        if ($validate->fails()) {
            return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
        } else {

            $query = Permission::find($request->permission_id)->update([
                'name' => $request->name,
            ]);

            return response()->json(['code' => 1, 'msg' => 'Success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $users = User::all();
        $permission_id = $request->permission_id;

        foreach ($users as $key => $value) {
            if ($value->hasDirectPermission(Permission::findById($permission_id))) {
                return response()->json(['code' => 0, 'msg' => 'Cannot delete Permission, has been assigned!']);
            } else {
                $query = Permission::find($permission_id)->delete();

                if ($query) {
                    return response()->json(['code' => 1, 'msg' => 'Success']);
                } else {
                    return response()->json(['code' => 0, 'msg' => 'Error encountered, Please try again']);
                }
            }
        }
    }
}
