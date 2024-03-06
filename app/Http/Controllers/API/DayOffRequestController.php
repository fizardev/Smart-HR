<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DayOffRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayOffRequestController extends Controller
{
    public function store()
    {
        try {
            $validator = \Validator::make(request()->all(), [
                'date' => 'required',
                'photo' => 'nullable|file',
                'description' => 'required|string',
                'employee_id' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            // Ambil rentang tanggal dari permintaan
            $dateRange = explode(' - ', request()->date);
            // Ubah tanggal ke format Y-m-d
            $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('m/d/Y', $dateRange[1])->format('Y-m-d');
            $employee_id = request()->employee_id;
            $employee = Employee::find($employee_id);

            if (request()->hasFile('photo')) {
                $image = request()->file('photo');
                $imageName = request()->attendance_code_id . '_cuti_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/img/pengajuan/cuti', $imageName);
                // Create company dengan file logo

                DayOffRequest::create([
                    'attendance_code_id' => request()->attendance_code_id,
                    'employee_id' => $employee_id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'approved_line_child' => $employee->approval_line,
                    'approved_line_parent' => $employee->approval_line_parent,
                    'photo' => $imageName,
                    'description' => request()->description,
                ]);
            } else {
                DayOffRequest::create([
                    'attendance_code_id' => request()->attendance_code_id,
                    'employee_id' => $employee_id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'approved_line_child' => $employee->approval_line,
                    'approved_line_parent' => $employee->approval_line_parent,
                    'description' => request()->description,
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
        $day_off_request = DayOffRequest::find($id);
        // dd($day_off_request);
        if ($day_off_request->approved_line_child !== null && $day_off_request->approved_line_parent == null) {
            $is_approved = "Disetujui";
        } else if (($day_off_request->approved_line_child !== null && $day_off_request->approved_line_parent !== null) && ($day_off_request->approved_line_child == request()->employee_id)) {
            $is_approved = "Verifikasi";
        } else if (($day_off_request->approved_line_child !== null && $day_off_request->approved_line_parent !== null) && ($day_off_request->approved_line_parent == request()->employee_id)) {
            $is_approved = "Disetujui";
            $startDate = Carbon::parse($day_off_request->start_date);
            $endDate = Carbon::parse($day_off_request->end_date);

            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                // Lakukan sesuatu dengan $date di sini
                // echo $date->toDateString() . "\n";
                DB::table('attendances')
                    ->where('date', $date->toDateString())
                    ->where('employee_id', $day_off_request->employee_id)
                    ->update(['is_day_off' => '1', 'day_off_request_id' => $id, 'clock_in' => null, 'clock_out' => null]);
            }
        }
        $day_off_request->update([
            'is_approved' => $is_approved
        ]);

        return response()->json(['message' => 'Status Pengajuan: ' . $is_approved]);
    }
}
