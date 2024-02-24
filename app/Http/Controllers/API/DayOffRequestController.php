<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\DayOffRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            // Ambil data kehadiran berdasarkan rentang tanggal dan employee_id
            // $attendances = Attendance::where('employee_id', request()->employee_id)
            //     ->whereBetween('date', [$startDate, $endDate])
            //     ->get();
            $employee_id = request()->employee_id;
            if (request()->hasFile('photo')) {
                $image = request()->file('photo');
                $imageName = request()->attendance_code_id . '_cuti_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/img/pengajuan/cuti', $imageName);
                // Create company dengan file logo

                DayOffRequest::create([
                    'attendance_code_id' => request()->attendance_code_id,
                    'employee_id ' => $employee_id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'photo' => $imageName,
                    'description' => request()->description,
                ]);
            } else {
                DayOffRequest::create([
                    'attendance_code_id' => request()->attendance_code_id,
                    'employee_id ' => 2,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
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
}
