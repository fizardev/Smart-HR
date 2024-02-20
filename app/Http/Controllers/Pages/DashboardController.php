<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceCode;
use App\Models\Bank;
use App\Models\BankEmployee;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\Organization;
use App\Models\Shift;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $attendances = Attendance::orderBy('id', 'desc')->limit(3)->get();
        $lastAttendance = Attendance::latest()->first();
        return view('dashboard', [
            'attendances' => $attendances,
            'lastAttendance' => $lastAttendance
        ]);
    }

    public function  getDataUsers()
    {
        $users = User::all();
        $roles = Role::all();
        return view('pages.master-data.user.index', compact('users', 'roles'));
    }

    public function  getDataUser()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();
        $employee = $user->employee;
        $company = Company::first();

        $roles = Role::all();
        return view('pages.pegawai.profil-pegawai.index', compact('user', 'roles', 'employee', 'company'));
    }

    public function  getDataOrganizations()
    {
        $organizations = Organization::all();
        return view('pages.master-data.organization.index', compact('organizations'));
    }

    public function getDataJobLevels()
    {
        $jobLevel = JobLevel::all();
        return view('pages.master-data.job-level.index', compact('jobLevel'));
    }

    public function getDataJobPositions()
    {
        $jobPosition = JobPosition::all();
        return view('pages.master-data.job-position.index', compact('jobPosition'));
    }
    public function getDataEmployees()
    {
        $employees = Employee::all();
        $jobLevel = JobLevel::all();
        $organizations = Organization::all();
        $jobPosition = JobPosition::all();

        return view('pages.pegawai.daftar-pegawai.index', compact('employees', 'jobLevel', 'organizations', 'jobPosition'));
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
