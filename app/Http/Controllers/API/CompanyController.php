<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'province' => 'required',
            'city' => 'required',
            'logo' => 'nullable',
            'category' => 'required',
            'class' => 'required',
            'operating_permit_number' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find company by ID
        $company = Company::find($id);

        //check if image is not empty
        if ($request->hasFile('logo')) {

            //upload logo
            $image = $request->file('logo');
            Storage::delete('public/img/' . basename($company->logo));
            $image->storeAs('public/img/', 'logo.png');

            //delete old image

            //update company with new image
            $company->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'logo' => 'logo.png',
                'category' => $request->category,
                'class' => $request->class,
                'operating_permit_number' => $request->operating_permit_number,
            ]);
        } else {

            //update company without image
            $company->update([
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'province' => $request->province,
                'city' => $request->city,
                'category' => $request->category,
                'class' => $request->class,
                'operating_permit_number' => $request->operating_permit_number,
            ]);
        }

        //return response
        return response()->json(['message' => 'Detail Perusahaan Berhasil di Update!']);
    }
}
