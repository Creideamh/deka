<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // get all company branches 
    public function getBranches(Request $request)
    {
        $branches = branch::where('company_id', '=', $request->company)->get();
        return response()->json(['code' => 0, 'details' => $branches]);
    }
}
