<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\AttendanceCode;
use App\Models\Bank;
use App\Models\BankEmployee;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\Organization;
use App\Models\Shift;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function  getDataOrganizations()
    {
        $organizations = Organization::all();
        return view('pages.master-data.organization.index', [
            'organizations' => $organizations,
        ]);
    }

    public function getDataJobLevels()
    {
        return view('pages.master-data.job-level.index', [
            'jobLevel' => JobLevel::all(),
        ]);
    }

    public function getDataJobPositions()
    {
        return view('pages.master-data.job-position.index', [
            'jobPosition' => JobPosition::all(),
        ]);
    }
    public function getDataEmployees()
    {
        return view('pages.pegawai.daftar-pegawai.index', [
            'jobPosition' => JobPosition::all(),
            'organization' => Organization::all(),
            'jobLevel' => JobLevel::all(),
            'employees' => Employee::all(),
        ]);
    }
    public function getDataHolidays()
    {
        return view('pages.master-data.holidays.index', [
            'holidays' => Holiday::all()
        ]);
    }
    public function getDataAttendanceCodes()
    {
        return view('pages.master-data.attendance-code.index', [
            'attendance_code' => AttendanceCode::all()
        ]);
    }
    public function getDataShifts()
    {
        return view('pages.master-data.shift.index', [
            'shifts' => Shift::all()
        ]);
    }
    public function getDataBanks()
    {
        return view('pages.master-data.banks.index', [
            'banks' => Bank::all()
        ]);
    }
    public function getDataBankEmployees()
    {
        return view('pages.master-data.bank-employees.index', [
            // 'bank_employees' => BankEmployee::all(),
            'employees' => Employee::all(),
            'banks' => Bank::all()
        ]);
    }
    public function getDataStructures()
    {
        return view('pages.master-data.structures.index', [
            'organizations' => Organization::all(),
            'structures' => Structure::all()
        ]);
    }
}
