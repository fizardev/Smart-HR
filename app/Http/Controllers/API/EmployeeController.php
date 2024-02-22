<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        try {
            $employees = Employee::all();
            return response()->json($employees, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], 404);
        }
    }

    public function edit($id)
    {
        try {
            $employee = Employee::where('id', $id)->first();
            return response()->json($employee, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], 404);
        }
    }

    public function updatePersonal($id)
    {
        try {
            // Validasi input
            $validator = $this->validate(request(), [
                'fullname' => 'required|string|max:255',
                'gender' => 'required|in:Laki-laki,Perempuan',
                'mobile_phone' => 'required|string|max:15',
                'place_of_birth' => 'required|string|max:255',
                'marital_status' => 'required|in:Lajang,Menikah,Janda,Duda',
                'email' => 'required|string|email|max:255',
                'birthdate' => 'required|date|date_format:Y-m-d',
                'religion' => 'required|string|in:Islam,Katholik,Kristen,Budha,Hindu,Lainnya',
                'blood_type' => 'nullable|string|max:255', // Golongan darah boleh kosong
            ]);

            // Cari employee berdasarkan ID
            $employee = Employee::findOrFail($id);

            // Perbarui data employee dengan data yang divalidasi
            $employee->update($validator);

            // Return response
            return response()->json(['message' => 'Pengguna berhasil diupdate']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan pesan kesalahan
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function updateIdentitas($id)
    {
        try {
            // Validasi input
            $validator = $this->validate(request(), [
                'identity_type' => 'required|string|max:255',
                'postal_code' => 'required|string|max:255',
                'identity_number' => 'nullable|string|max:255',
                'citizen_id_address' => 'required|string|max:255',
                'identity_expire_date' => 'nullable|date|date_format:Y-m-d',
                'residental_address' => 'required|string|max:255',
            ]);

            // Cari employee berdasarkan ID
            $employee = Employee::findOrFail($id);

            // Perbarui data employee dengan data yang divalidasi
            $employee->update($validator);

            // Return response
            return response()->json(['message' => 'Identitas berhasil diupdate']);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan pesan kesalahan
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }



    public function store()
    {
        try {
            Employee::create(request()->all());
            //return response
            return response()->json(['message' => 'Pegawai Berhasil di Tambahkan!']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 404);
        }
    }
}
