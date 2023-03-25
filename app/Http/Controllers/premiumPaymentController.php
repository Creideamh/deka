<?php

namespace App\Http\Controllers;

use App\Models\premium_payer;
use App\Models\premium_payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class premiumPaymentController extends Controller
{
    //

    public function index()
    {
        return view('eternity-plus.premium-payments.index');
    }

    // Get premium payer and payment information
    public function getPremiumPayment(Request $request)
    {
        $premiumPayer = premium_payer::where('application_id', $request->application_id)->get();
        $premiumPayment  = premium_payment::where('application_id', $request->application_id)->get();
        return response()->json(['payerDetails' => $premiumPayer, 'paymentDetails' => $premiumPayment]);
    }

    // Update payer and payment details
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'premium_title' => 'required',
            'premium_surname' => 'required|string',
            'premium_firstname' => 'required|string',
            'premium_birthdate' => 'required|date',
            'premium_email' => 'required|string',
            'premium_mobile_number' => 'required|min:12',
            'premium_tin' => 'required',
            'premium_risk' => 'required|numeric',
            'premium_savings' => 'required|numeric',
            'premium_fee' => 'required|numeric',
            'premium_total' => 'required|numeric',
            'premium_mode' => 'required|string',
            'premium_frequency' => 'required',
            'premium_deduction' => 'required|date',
            'premium_increase' => 'required|numeric',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' => $validate->errors()->toArray()]);
        }

        // Ensure premium start deduction date is not less or equal to today's date
        if ($request->premium_deduction <= now()) {
            return response()->json(['code' => 0, 'msg' => 'Deduction start date must not be less or equal to today\'s date']);
        }

        // Update payer table 
        $payerUpdate = premium_payer::where('application_id', '=', $request->application_id)->update([
            'premium_title' => $request->premium_title,
            'premium_surname' => $request->premium_surname,
            'premium_firstname' => $request->premium_firstname,
            'premium_birthdate' => $request->premium_birthdate,
            'premium_email' => $request->premium_email,
            'premium_mobile_number' => $request->premium_mobile_number,
            'premium_tin_number' => $request->premium_tin,
        ]);

        if (!$payerUpdate) {
            return response()->json(['code' => 0, 'msg' => 'Error encountered, Please try again or contact System Administrator']);
        }


        // Update Payer payment information
        $paymentUpdate = premium_payment::where('application_id', '=', $request->application_id)->update([
            'premium_risk' => $request->premium_risk,
            'premium_savings' => $request->premium_savings,
            'premium_fee' => $request->premium_fee,
            'premium_total' => $request->premium_total,
            'premium_mode' => $request->premium_mode,
            'premium_frequency' => $request->premium_frequency,
            'premium_deduction' => $request->premium_deduction,
            'premium_increase' => $request->premium_increase,
        ]);

        if (!$paymentUpdate) {
            return response()->json(['code' => 0, 'msg' => 'Error encountered, Please try again or contact System Administrator']);
        }


        return response()->json(['code' => 1, 'msg' => 'Successfully Updated']);
    }
}
