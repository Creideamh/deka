<?php

namespace App\Http\Controllers;

use App\Models\beneficiary;
use App\Models\trustee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class beneficiaryController extends Controller
{
    //
    public function index()
    {
        return view('eternity-plus.beneficiaries.index');
    }

    /**
     * List all Beneficiaries available
     */
    public function allBeneficiaries($id)
    {
        $beneficiaries_ = beneficiary::where('application_id', '=', $id);

        return  DataTables::of($beneficiaries_)
            ->addIndexColumn()
            ->addColumn('fullname', function ($rows) {
                return $rows->surname . ', ' . $rows->firstname;
            })
            ->addColumn('beneficiary_gender', function ($rows) {
                return $rows->beneficiary_gender;
            })
            ->addColumn('beneficiary_relationship', function ($rows) {
                return $rows->beneficiary_relationship;
            })
            ->addColumn('benefit_percentage', function ($rows) {
                return $rows->benefit_percentage;
            })
            ->addColumn('beneficiary_contact', function ($rows) {
                return $rows->beneficiary_contact;
            })
            ->addColumn('actions', function ($rows) {
                return '
                <a href="#" id="editBeneficiaryBtn" data-id="' . $rows->id . '" data-bs-toggle="modal" data-bs-target="#myEditModal"><span class="badge text-bg-primary"><i class="far fa-edit"></i></span></a>
                <a href="#" onclick="deleteBeneficiary(' . $rows->id . ')"><span class="badge text-bg-danger"><i class="fas fa-trash"></i></span></a>
                ';
            })
            ->rawColumns(['actions', 'fullname'])
            ->make(true);
    }

    /**
     *  Store Beneficiary Data and or Trustee Data
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'surname' => 'required|string',
            'gender' => 'required|string',
            'birthdate' => 'required|date',
            'relationship' => 'required|string',
            'contact' => 'required|string|max:15,min:15',
            'benefit' => 'required|integer',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' =>  $validate->errors()->toArray()]);
        }



        // Must ensure that benefit percentage does not exceed 100
        $currentPercentage = beneficiary::where('application_id', '=', $request->application_id)->sum('benefit_percentage');
        $percentageCalculate = $request->benefit + $currentPercentage;

        if ($percentageCalculate > 100) {
            return response()->json(['code' => 2, 'msg' => 'Benefit Percentage exceeds 100, Delete or reduce percentage values for the other beneficiaries']);
        }



        // Trustee Data 
        if (!empty($request->surname)) {

            $validator = Validator::make($request->all(), [
                'trustee_surname' => 'required|string',
                'trustee_firstname' => 'required|string',
                'trustee_gender' => 'required',
                'trustee_birthdate' => 'required|date',
                'trustee_relationship' => 'required',
                'trustee_address' => 'required|min:20',
                'trustee_contact' => 'required|max:15,min:15'
            ]);

            if (!$validator->passes()) {
                return response()->json(['code' => 5, 'error' =>  $validator->errors()->toArray()]);
            }


            /*
            *   Only one trustee is needed 
            *   Don't add to trustee table if it already exists
                Update existing trustee data
            **/

            $trusteeInfo = trustee::where('application_id', $request->application_id)->get();

            if (count($trusteeInfo) > 0) {

                $trusteeUpdate = trustee::where('application_id', $request->application_id)->update([
                    'surname' => $request->trustee_surname,
                    'firstname' => $request->trustee_firstname,
                    'trustee_gender' => $request->trustee_gender,
                    'trustee_birthdate' => $request->trustee_birthdate,
                    'trustee_relationship' => $request->trustee_relationship,
                    'trustee_address' => $request->trustee_address,
                    'trustee_contact' => $request->trustee_contact,
                    'application_id' => $request->application_id
                ]);

                if (!$trusteeUpdate) {
                    return response()->json(['code' => 3, 'msg' =>  'Unable to update Trustee Information']);
                }

                $beneficiary = new beneficiary();
                $beneficiary->firstname = $request->firstname;
                $beneficiary->surname = $request->surname;
                $beneficiary->beneficiary_gender = $request->gender;
                $beneficiary->beneficiary_relationship = $request->relationship;
                $beneficiary->beneficiary_contact = $request->contact;
                $beneficiary->beneficiary_date = $request->birthdate;
                $beneficiary->benefit_percentage = $request->benefit;
                $beneficiary->application_id = $request->application_id;

                if ($beneficiary->save()) {
                    return response()->json(['code' => 1, 'msg' => 'Beneficiary successfully created, Trustee data updated successfully']);
                }
            }


            $trustee = new trustee();

            $trustee->surname = $request->trustee_surname;
            $trustee->firstname = $request->trustee_firstname;
            $trustee->trustee_gender = $request->trustee_gender;
            $trustee->trustee_birthdate = $request->trustee_birthdate;
            $trustee->trustee_relationship = $request->trustee_relationship;
            $trustee->trustee_contact = $request->trustee_contact;
            $trustee->trustee_address = $request->trustee_address;
            $trustee->application_id = $request->application_id;

            if (!$trustee->save()) {
                return response()->json(['code' => 4, 'msg' => 'Unable to add Trustee Information']);
            }
        }

        $beneficiary = new beneficiary();
        $beneficiary->firstname = $request->firstname;
        $beneficiary->surname = $request->surname;
        $beneficiary->beneficiary_gender = $request->gender;
        $beneficiary->beneficiary_relationship = $request->relationship;
        $beneficiary->beneficiary_contact = $request->contact;
        $beneficiary->beneficiary_date = $request->birthdate;
        $beneficiary->benefit_percentage = $request->benefit;
        $beneficiary->application_id = $request->application_id;

        if ($beneficiary->save()) {
            return response()->json(['code' => 1, 'msg' => 'Beneficiary successfully created']);
        }

        return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
    }


    // Delete Beneficiary
    public function deleteBeneficiary(Request $request)
    {
        // Get Beneficiary details & Delete
        $beneficiary = beneficiary::find($request->beneficiary_id)->delete();

        if ($beneficiary) {
            return response()->json(['code' => 1, 'msg' => 'Beneficiary deleted successfully']);
        }

        return response()->json(['code' => 0, 'msg' => 'Failed to delete Beneficiary']);
    }


    public function getBeneficiaryDetail(Request $request)
    {
        $beneficiaryInfo = beneficiary::find($request->beneficiary_id);
        $trusteeInfo     = trustee::where('application_id', $beneficiaryInfo->application_id)->get();
        return response()->json(['details' => $beneficiaryInfo, 'details_b' => $trusteeInfo]);
    }

    private function checkAgeAndOrDeleteTrustee($param_1, $param_2)
    {
        /*
         * loop through the beneficiar with this application id
         * if there are  birthdates greater than '2005-01-01'
         * delete any trustee information
        **/
        $beneficiaries = beneficiary::where('application_id', '=', $param_1)
            ->where('beneficiary_date', '>', '2005-01-01')
            ->get();

        if (count($beneficiaries) <= 0) {
            return  $deleteTrusteeInfo  = trustee::find($param_1)->delete();
        }
    }


    public function update(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'eFirstname' => 'required|string',
            'eSurname' => 'required|string',
            'eGender' => 'required|string',
            'eBirthdate' => 'required|date',
            'eRelationship' => 'required|string',
            'eContact' => 'required|string|max:15,min:15',
            'eBenefit' => 'required|integer',
        ]);

        if (!$validate->passes()) {
            return response()->json(['code' => 0, 'error' =>  $validate->errors()->toArray()]);
        }

        // Get sum of benefit percentage
        // Must ensure that benefit percentage does not exceed 100
        $currentPercentage = beneficiary::where('application_id', '=', $request->application_id)->sum('benefit_percentage');
        $percentageCalculate = $request->benefit + $currentPercentage;

        if ($percentageCalculate > 100) {
            return response()->json(['code' => 2, 'msg' => 'Benefit Percentage exceeds 100, Delete or reduce percentage values for the other beneficiaries']);
        }

        // beneficiary age 
        $beneficiaryAge = Carbon::parse($request->eBirthdate)->age;

        if ($beneficiaryAge >= 18) {
            // Just update beneficiary Information
            $beneficiaryInfo = beneficiary::find($request->beneficiary_id)->update([
                'surname' => $request->eSurname,
                'firstname' => $request->eFirstname,
                'beneficiary_gender' => $request->eGender,
                'beneficiary_date' => $request->eBirthdate,
                'beneficiary_relationship' => $request->eRelationship,
                'benefit_percentage' => $request->eBenefit,
                'beneficiary_contact' => $request->eContact
            ]);

            if (!$beneficiaryInfo) {
                return response()->json(['code' => 0, 'msg' => 'Failed to update Beneficiary information']);
            }

            $this->checkAgeAndOrDeleteTrustee($request->application_id, $request->trustee_id);

            return response()->json(['code' => 1, 'msg' => 'Update Successfully']);
        }

        // Gather information about trustee
        $validator = Validator::make($request->all(), [
            'eTrustee_surname' => 'required|string',
            'eTrustee_firstname' => 'required|string',
            'eTrustee_gender' => 'required',
            'eTrustee_birthdate' => 'required|date',
            'eTrustee_relationship' => 'required',
            'eTrustee_address' => 'required|min:20',
            'eTrustee_contact' => 'required|max:15,min:15'
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 5, 'error' =>  $validator->errors()->toArray()]);
        }

        // Update trustee
        $trusteeInfo = trustee::find($request->trustee_id)->update([
            'surname' => $request->eTrustee_surname,
            'firstname' => $request->eTrustee_firstname,
            'trustee_gender' => $request->eTrustee_gender,
            'trustee_birthdate' => $request->eTrustee_birthdate,
            'trustee_relationship' => $request->eTrustee_relationship,
            'trustee_address' => $request->eTrustee_address,
            'trustee_contact' => $request->eTrustee_contact,
        ]);

        if (!$trusteeInfo) {
            return response()->json(['code' => 0, 'msg' => 'Failed to update Trustee information']);
        }

        // If no errors in trustee information
        $beneficiaryInfo = beneficiary::find($request->beneficiary_id)->update([
            'surname' => $request->eSurname,
            'firstname' => $request->eFirstname,
            'beneficiary_gender' => $request->eGender,
            'beneficiary_date' => $request->eBirthdate,
            'beneficiary_relationship' => $request->eRelationship,
            'benefit_percentage' => $request->eBenefit,
            'beneficiary_contact' => $request->eContact
        ]);

        if (!$beneficiaryInfo) {
            return response()->json(['code' => 0, 'msg' => 'Failed to update Beneficiary information']);
        }


        return response()->json(['code' => 1, 'msg' => 'Update successfully']);
    }
}
