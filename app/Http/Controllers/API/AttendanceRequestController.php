<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use Illuminate\Http\Request;

class AttendanceRequestController extends Controller
{

    public function getAttendance($id)
    {

        try {
            $attendance = AttendanceRequest::findOrFail($id);

            // return dd([
            //     'clockin' => $attendance->clockin,
            //     'clockout' => $attendance->clockout,
            // ]);
            // return dd($attendance->clockin != null && $attendance->clockout != null);


            if ($attendance->clockin != null && $attendance->clockout != null) {
                $req = "Kontol pada " . $attendance->clockin . " dan Checkout pada " . $attendance->clockout;
            } else if ($attendance->clockin == null && $attendance->clockout != null) {
                $req = "Checkout pada " . $attendance->clockout;
            } else if ($attendance->clockin != null && $attendance->clockout == null) {
                $req = "Clockin pada " . $attendance->clockin;
            }

            return response()->json([
                'attendanceRequest' => $attendance,
                'attendance' => $attendance->attendance,
                'employee' => $attendance->attendance->employee,
                'request' => $req,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result'
            ], 404);
        }
    }

    public function store()
    {
        // return dd(request()->all());

        try {
            $validator = \Validator::make(request()->all(), [
                'date' => 'required|date',
                'clockin' => 'required_if:check_clockin,on|date_format:H:i',
                'clockout' => 'required_if:check_clockout,on|date_format:H:i',
                'file' => 'nullable|file',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $attendance_id = Attendance::where('date', request()->date)
                ->get('id')
                ->first()
                ->id;

            AttendanceRequest::create([
                'attendance_id' => $attendance_id,
                'date' => request()->date,
                'clockin' => request()->clockin,
                'clockout' => request()->clockout,
                'file' => request()->file,
                'description' => request()->description,
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
