<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceCode;
use App\Models\AttendanceRequest;
use App\Models\Bank;
use App\Models\BankEmployee;
use App\Models\Company;
use App\Models\DayOffRequest;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\Organization;
use App\Models\Shift;
use App\Models\Structure;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $employeeID = Auth::user()->employee->id;
        // Mengambil tiga entri terakhir untuk seorang karyawan berdasarkan employee_id dan tanggal
        $attendances = Attendance::where('employee_id', $employeeID)
            ->whereDate('date', '<=', Carbon::now()) // Tanggal harus lebih besar dari atau sama dengan tanggal kemarin
            ->orderBy('date', 'desc') // Urutkan berdasarkan tanggal secara menurun
            ->limit(3) // Batasi hasil menjadi tiga entri
            ->get();

        return view('dashboard', [
            'attendances' => $attendances,
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

        $employeeID = Auth::user()->employee->id;
        // Mengambil tiga entri terakhir untuk seorang karyawan berdasarkan employee_id dan tanggal
        $attendances = Attendance::where('employee_id', $employeeID)
            ->whereDate('date', '<=', Carbon::now()) // Tanggal harus lebih besar dari atau sama dengan tanggal kemarin
            ->orderBy('date', 'desc') // Urutkan berdasarkan tanggal secara menurun
            ->limit(3) // Batasi hasil menjadi tiga entri
            ->get();

        $attendances = AttendanceRequest::all();

        $roles = Role::all();
        return view('pages.pegawai.profil-pegawai.index', compact('user', 'roles', 'employee', 'company', 'attendances'));
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
    public function getManagementShift()
    {
        return view('pages.pegawai.manajemen-shift.index');
    }
    public function dayOffRequest()
    {
        $day_off_requests = DayOffRequest::all();
        $attendance_code = AttendanceCode::all();
        return view('pages.pengajuan.pengajuan-cuti.index', compact('day_off_requests', 'attendance_code'));
    }
}
