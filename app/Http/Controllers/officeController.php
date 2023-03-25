<?php

namespace App\Http\Controllers;

use App\Models\application;
use App\Models\intermediary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class officeController extends Controller
{

    public function index($id)
    {
        $declareInfo = application::find($id);
        return view('eternity-plus.office.index', ['declareInfo' => $declareInfo]);
    }

    public function update(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'declarant_signature' => 'required|string'
        ]);


        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        }

        $signature = $request->declarant_signature;
        $signature = str_replace('data:image/png;base64,', '', $signature);
        $signature = str_replace(' ', '+', $signature);
        $data = base64_decode($signature);
        $file_name = md5(microtime() . date('Y-m-d')) . '.png';
        $file_path = public_path('uploads/customers/' . $file_name);
        $loc = file_put_contents($file_path, $data);

        $intermediaryInfo = intermediary::find($request->application_id)->update([
            'customer_signature' => $file_name,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        if (!$intermediaryInfo) {
            return response()->json(['code' => 0, 'msg' => 'failed to sign document']);
        }

        return response()->json(['code' => 1, 'msg' => 'Yey, you signed successfully']);

        // $file = APPPATH . md5(microtime().date('Y-m-d')).'.png';
        // $success = file_put_contents($file, $data);
    }
}
