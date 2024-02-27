<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Imports\AttendanceImport;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    public function clock_in(Request $request)
    {
        try {
            // koordinat perusahaan
            $perusahaanLatitude = -6.764979921860473;
            $perusahaanLongitude = 108.17781765944311;
            $radiusPerusahaan = 1; // Radius dalam kilometer

            // Koordinat Absensi
            $penggunaLatitude = $request->latitude;
            $penggunaLongitude = $request->longitude;

            // Hitung jarak antara titik absensi dan perusahaan
            $jarak = haversine($perusahaanLatitude, $perusahaanLongitude, $penggunaLatitude, $penggunaLongitude);

            // Validasi apakah pengguna berada dalam radius perusahaan
            if ($jarak <= $radiusPerusahaan) {
                $employee_id = $request->employee_id;
                $request['date'] = now()->format('Y-m-d');
                $request['location'] = $request->latitude . "," . $request->longitude;
                // $request['early_clock_out'] = null;
                $validator = \Validator::make($request->all(), [
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'clock_in' => 'nullable',
                    'clock_out' => 'nullable',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $request['clock_in'] = Carbon::now();
                // $waktu_absen = Carbon::createFromFormat('H:i', '08:00');
                $attendance = Attendance::where('employee_id', $employee_id)->where('date', $request->date)->first();

                $waktu_absen = $attendance->shift->time_in;
                $perbedaanMenit = $request->clock_in->greaterThan($waktu_absen) ? $request->clock_in->diffInMinutes($waktu_absen) : null;
                $request['late_clock_in'] = $perbedaanMenit;
                $attendance->update($request->all());

                return response()->json(['message' => 'Berhasil Clock In!']);
            } else {
                return response()->json(['error' => 'Lokasi tidak terdeteksi!'], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Pegawai belum memiliki shift!"
            ], 404);
        }
    }
    public function clock_out(Request $request)
    {
        try {
            // koordinat perusahaan
            $perusahaanLatitude = -6.764979921860473;
            $perusahaanLongitude = 108.17781765944311;
            $radiusPerusahaan = 1; // Radius dalam kilometer

            // Koordinat Absensi
            $penggunaLatitude = $request->latitude;
            $penggunaLongitude = $request->longitude;

            // Hitung jarak antara titik absensi dan perusahaan
            $jarak = haversine($perusahaanLatitude, $perusahaanLongitude, $penggunaLatitude, $penggunaLongitude);

            // Validasi apakah pengguna berada dalam radius perusahaan
            if ($jarak <= $radiusPerusahaan) {

                $validator = \Validator::make($request->all(), [
                    'latitude' => 'required',
                    'longitude' => 'required',
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                $waktu_sekarang = now()->format('Y-m-d');
                $attendance = Attendance::where('employee_id', $request->employee_id)->where('date', $waktu_sekarang)->first();
                $waktu_absen_pulang = $attendance->shift->time_out;
                $clock_out = Carbon::now();
                $perbedaanMenit = $clock_out->lessThan($waktu_absen_pulang) ? $clock_out->diffInMinutes($waktu_absen_pulang) : null;

                if ($attendance->clock_in !== null) {
                    $attendance->update([
                        'clock_out' => $clock_out,
                        'early_clock_out' => $perbedaanMenit,
                    ]);
                    return response()->json(['message' => 'Berhasil Clock Out!']);
                } else {
                    return response()->json(['error' => 'Anda belum clock in!'], 422);
                }

                Attendance::create($request->all());

                return response()->json(['message' => 'Berhasil Clock In!']);
            } else {
                return response()->json(['error' => 'Lokasi tidak terdeteksi!'], 422);
            }


            //return response
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Pegawai belum memiliki shift!"
            ], 404);
        }
    }

    public function import(Request $request)
    {
        Excel::import(new AttendanceImport, $request->file('attendance_shift'));
        return response()->json(['message' => 'Jadwal Shift Berhasil di Tambahkan!']);
    }
}
