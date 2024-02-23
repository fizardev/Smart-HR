<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Illuminate\Http\Request;

class AttendanceRequestController extends Controller
{

    public function store()
    {
        // return dd(request()->all());

        try {
            $validator = \Validator::make(request()->all(), [
                'date' => 'required|date',
                'clockin' => 'required_if:check_clockin,on|date_format:H:i',
                'clockout' => 'required_if:check_clockout,on|date_format:H:i',
                'file' => 'nullable|file',
                'deskripsi' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $attendance = Attendance::where('date', request()->date)->get();

            return dd(request()->date);

            AttendanceRequest::create([
                'date' => request()->date,
                'clockin' => request()->clockin,
                'clockout' => request()->clockout,
                'file' => request()->file,
                'deskripsi' => request()->deskripsi,
            ]);

            //return response
            return response()->json(['message' => 'Request Absensi Berhasil di Tambahkan!']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
