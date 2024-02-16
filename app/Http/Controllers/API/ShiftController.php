<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    public function getShift($id)
    {
        try {
            $shift = Shift::findOrFail($id);
            return response()->json($shift, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], 404);
        }
    }
    public function store()
    {
        try {
            $validator = request()->validate([
                'name' => 'required',
                'time_in' => 'required',
                'time_out' => 'required',
            ]);

            $validator['status'] = 'aktif';

            Shift::create($validator);
            //return response
            return response()->json(['message' => 'Shift Berhasil di Tambahkan!']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result',
                'errorLaravel' => $e->getMessage()
            ], 404);
        }
    }
    public function update($id)
    {
        try {
            //define validation rules
            $validator = request()->validate([
                'name' => 'required',
                'time_in' => 'required',
                'time_out' => 'required',
                'status' => 'required',
            ]);

            //find company by ID
            $shift = Shift::find($id);
            $shift->update($validator);
            //return response
            return response()->json(['message' => 'Shift Berhasil di Update!']);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => 'No result',
                'error' => $e->getMessage(),
            ], 404);
        }
    }
    public function destroy($id)
    {
        try {
            $shift = Shift::find($id);
            $shift->delete();
            //return response
            return response()->json(['message' => 'Shift Berhasil di Hapus!']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result',
                'errorLaravel' => $e->getMessage()
            ], 404);
        }
    }
}
