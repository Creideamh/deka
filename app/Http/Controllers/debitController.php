<?php

namespace App\Http\Controllers;

use App\Models\debit_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class debitController extends Controller
{
    //
    public function index()
    {
        return view('eternity-plus.debits.index');
    }

    // Get premium payer and payment information
    public function getDebitDetails(Request $request)
    {
        $debits = debit_order::where('application_id', $request->application_id)->get();
        return response()->json(['details' => $debits]);
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'debit_order_surname' => 'required|string',
            'debit_order_firstname' => 'required|string',
            'account_type' => 'required',
            'account_number' => 'required|max:15, min:15',
            'bank_name' => 'required',
            'bank_branch' => 'required',
            'cheque' => 'required',
        ]);


        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'errors' => $validate->errors()->toArray()]);
        }


        $signature = $request->sig_dataUrl;
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $data = base64_decode($signature);
        $file_name = md5(microtime() . date('Y-m-d')) . '.png';
        $file_path = public_path('uploads/customers/' . $file_name);
        $loc = file_put_contents($file_path, $data);


        $accountUpdate = debit_order::where('application_id', '=', $request->application_id)->update([
            'debit_order_surname'   => $request->surname,
            'debit_order_firstname' => $request->firstname,
            'account_number' => $request->account_number,
            'account_type' => $request->account_type,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'account_signature' => $file_name,
            'updated_at' => $request->signed_date,
        ]);

        if (!$accountUpdate) {
            return response()->json(['code' => 0, 'msg' => 'System Error, Please try again or contact your System Administrator']);
        }

        return response()->json(['code' => 1, 'msg' => 'Account Updated successfully']);
    }
}
