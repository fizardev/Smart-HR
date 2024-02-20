<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

            // Hitung jarak antara dua titik 
            function haversine($lat1, $lon1, $lat2, $lon2)
            {
                $r = 6371; // Radius bumi dalam kilometer
                $dLat = deg2rad($lat2 - $lat1);
                $dLon = deg2rad($lon2 - $lon1);
                $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) * sin($dLon / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $d = $r * $c; // Jarak dalam kilometer
                return $d;
            }

            // Hitung jarak antara titik absensi dan perusahaan
            $jarak = haversine($perusahaanLatitude, $perusahaanLongitude, $penggunaLatitude, $penggunaLongitude);

            // Validasi apakah pengguna berada dalam radius perusahaan
            if ($jarak <= $radiusPerusahaan) {
                $request['employee_id'] = 1;
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
                $waktu_absen = Carbon::createFromFormat('H:i', '14:35');
                $perbedaanMenit = $request->clock_in->greaterThan($waktu_absen) ? $request->clock_in->diffInMinutes($waktu_absen) : null;
                $request['late_clock_in'] = $perbedaanMenit;


                Attendance::create($request->all());
            } else {
                return response()->json(['message' => 'Lokasi Absen Terlalu Jauh']);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No result',
                'errorLaravel' => $e->getMessage()
            ], 404);
        }
    }
}
