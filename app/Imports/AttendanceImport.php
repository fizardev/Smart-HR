<?php

namespace App\Imports;

use App\Models\Attendance;
use App\Models\AttendanceCode;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AttendanceImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Ambil tanggal-tanggal dari baris pertama, mulai dari kolom ketiga
        $dates = $rows->first()->slice(2);

        // Hapus judul kolom dari data
        $rows = $rows->slice(1);

        foreach ($rows as $row) {
            $employeeId = $row[0];
            $employeeName = $row[1];

            foreach ($row->slice(2) as $dateIndex => $attendanceCode) {
                // Pastikan kode absensi tidak kosong
                if (!empty($attendanceCode)) {
                    // Jika kode absensi bukan kosong, simpan data kehadiran
                    Attendance::create([
                        'employee_id' => $employeeId,
                        'employee_name' => $employeeName,
                        'shift_id' => Shift::where('name', $attendanceCode)->value('id'),
                        'date' => \Carbon\Carbon::createFromFormat('Y-m-d', $dates[$dateIndex]),
                    ]);
                }
            }
        }
    }
}
