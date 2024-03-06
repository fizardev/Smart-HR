<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;

class AttendanceRequestController extends Controller
{

    public function store()
    {
        // return dd(request()->all());

        try {
            $validator = Validator::make(request()->all(), [
                'date' => 'required|date',
                'clockin' => 'required_if:check_clockin,on|date_format:H:i',
                'clockout' => 'required_if:check_clockout,on|date_format:H:i',
                'file' => 'nullable|file',
                'deskripsi' => 'nullable|string',
            ]);

            $employee = Employee::where('id', request()->employee_id)->first(['approval_line', 'approval_line_parent']);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $attendance = Attendance::where('date', request()->date)->first();

            AttendanceRequest::create([
                'attendance_id' => $attendance->id,
                'date' => request()->date,
                'approved_line_child' => $employee->approval_line,
                'approved_line_parent' => $employee->approval_line_parent,
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
