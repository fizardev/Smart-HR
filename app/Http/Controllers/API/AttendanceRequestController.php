<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AttendanceRequestController extends Controller
{

    public function store()
    {
        // return dd(request()->all());

        try {
            $validator = Validator::make(request()->all(), [
                'employee_id' => 'required',
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

            $attendance = Attendance::where('date', request()->date)->where('employee_id', request()->employee_id)->first();

            if (request()->hasFile('file')) {
                $image = request()->file('file');
                $imageName = request()->date . '_absensi_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/img/pengajuan/absensi', $imageName);
                AttendanceRequest::create([
                    'employee_id' => request()->employee_id,
                    'attendance_id' => $attendance->id,
                    'date' => request()->date,
                    'approved_line_child' => $employee->approval_line,
                    'approved_line_parent' => $employee->approval_line_parent,
                    'clockin' => request()->clockin,
                    'clockout' => request()->clockout,
                    'file' => $imageName,
                    'deskripsi' => request()->deskripsi,
                ]);
            } else {
                AttendanceRequest::create([
                    'employee_id' => request()->employee_id,
                    'attendance_id' => $attendance->id,
                    'date' => request()->date,
                    'approved_line_child' => $employee->approval_line,
                    'approved_line_parent' => $employee->approval_line_parent,
                    'clockin' => request()->clockin,
                    'clockout' => request()->clockout,
                    'deskripsi' => request()->deskripsi,
                ]);
            }

            //return response
            return response()->json(['message' => 'Request Absensi Berhasil di Tambahkan!']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function approve($id)
    {
        $attendance_request = AttendanceRequest::find($id);
        // dd($attendance_request);
        if ($attendance_request->approved_line_child !== null && $attendance_request->approved_line_parent == null) {
            $is_approved = "Disetujui";
        } else if (($attendance_request->approved_line_child !== null && $attendance_request->approved_line_parent !== null) && ($attendance_request->approved_line_child == request()->employee_id)) {
            $is_approved = "Verifikasi";
        } else if (($attendance_request->approved_line_child !== null && $attendance_request->approved_line_parent !== null) && ($attendance_request->approved_line_parent == request()->employee_id)) {
            $is_approved = "Disetujui";

            DB::table('attendances')
                ->where('id', $attendance_request->attendance_id)
                ->where('employee_id', $attendance_request->employee_id)
                ->update(['clock_in' => $attendance_request->clockin, 'clock_out' => $attendance_request->clockout, 'late_clock_in' => null, 'early_clock_out' => null]);
        }
        $attendance_request->update([
            'is_approved' => $is_approved
        ]);

        return response()->json(['message' => 'Status Pengajuan: ' . $is_approved]);
    }
}
