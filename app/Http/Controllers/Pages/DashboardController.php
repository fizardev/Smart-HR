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
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    protected function getNotify()
    {
        $day_off_notify = DayOffRequest::where('approved_line_child', auth()->user()->employee->id)->orWhere('approved_line_parent', auth()->user()->employee->id)->latest()->get();
        $attendance_notify = AttendanceRequest::where('approved_line_child', auth()->user()->employee->id)->orWhere('approved_line_parent', auth()->user()->employee->id)->get();
        $day_off_count_child = DayOffRequest::where('approved_line_child', auth()->user()->employee->id)->where('is_approved', 'Pending')->count();
        $day_off_count_parent = DayOffRequest::where('approved_line_parent', auth()->user()->employee->id)->where('is_approved', 'Verifikasi')->count();
        $attendance_count_child = AttendanceRequest::where('approved_line_child', auth()->user()->employee->id)->where('is_approved', 'Pending')->count();
        $attendance_count_parent = AttendanceRequest::where('approved_line_parent', auth()->user()->employee->id)->where('is_approved', 'Verifikasi')->count();
        return [
            'day_off_notify' => $day_off_notify,
            'attendance_notify' => $attendance_notify,
            'day_off_count_child' => $day_off_count_child,
            'day_off_count_parent' => $day_off_count_parent,
            'attendance_count_parent' => $attendance_count_parent,
            'attendance_count_child' => $attendance_count_child
        ];
    }

    public function index()
    {
        $employeeID = Auth::user()->employee->id;
        // Mengambil tiga entri terakhir untuk seorang karyawan berdasarkan employee_id dan tanggal
        $attendances = Attendance::where('employee_id', $employeeID)
            ->whereDate('date', '<=', Carbon::now()) // Tanggal harus lebih besar dari atau sama dengan tanggal kemarin
            ->orderBy('date', 'desc') // Urutkan berdasarkan tanggal secara menurun
            ->limit(3) // Batasi hasil menjadi tiga entri
            ->get();
        $day_off_notify = $this->getNotify()['day_off_notify'];
        $attendance_notify = $this->getNotify()['attendance_notify'];
        // dd($this->getNotify());
        return view('dashboard', [
            'attendances' => $attendances,
            'getNotify' => $this->getNotify()
        ]);
    }

    public function  getDataUsers()
    {
        $users = User::all();
        $roles = Role::all();
        $getNotify = $this->getNotify();
        return view('pages.master-data.user.index', compact('users', 'roles', 'getNotify'));
    }

    public function  getDataUser()
    {
        $userId = auth()->user()->id;
        $user = User::where('id', $userId)->first();
        $employee = $user->employee;
        $company = Company::first();
        $getNotify = $this->getNotify();
        $attendances = AttendanceRequest::all();

        $roles = Role::all();
        return view('pages.pegawai.profil-pegawai.index', compact('user', 'roles', 'employee', 'company', 'getNotify'));
    }

    public function  getDataOrganizations()
    {
        $organizations = Organization::all();
        $getNotify = $this->getNotify();
        return view('pages.master-data.organization.index', compact('organizations', 'getNotify'));
    }

    public function getDataJobLevels()
    {
        $jobLevel = JobLevel::all();
        $getNotify = $this->getNotify();
        return view('pages.master-data.job-level.index', compact('jobLevel', 'getNotify'));
    }

    public function getDataJobPositions()
    {
        $jobPosition = JobPosition::all();
        $getNotify = $this->getNotify();
        return view('pages.master-data.job-position.index', compact('jobPosition', 'getNotify'));
    }

    public function getDataEmployees()
    {
        $employees = Employee::all();
        $jobLevel = JobLevel::all();
        $organizations = Organization::all();
        $jobPosition = JobPosition::all();
        $getNotify = $this->getNotify();

        return view('pages.pegawai.daftar-pegawai.index', compact('employees', 'jobLevel', 'organizations', 'jobPosition', 'getNotify'));
    }

    public function getDataHolidays()
    {
        return view('pages.master-data.holidays.index', [
            'holidays' => Holiday::all(),
            'getNotify' => $this->getNotify()
        ]);
    }

    public function getDataAttendanceCodes()
    {
        return view('pages.master-data.attendance-code.index', [
            'attendance_code' => AttendanceCode::all(),
            'getNotify' => $this->getNotify()
        ]);
    }

    public function getDataShifts()
    {
        return view('pages.master-data.shift.index', [
            'shifts' => Shift::all(),
            'getNotify' => $this->getNotify()
        ]);
    }

    public function getDataBanks()
    {
        return view('pages.master-data.banks.index', [
            'banks' => Bank::all(),
            'getNotify' => $this->getNotify()
        ]);
    }

    public function getDataBankEmployees()
    {
        return view('pages.master-data.bank-employees.index', [
            // 'bank_employees' => BankEmployee::all(),
            'employees' => Employee::all(),
            'getNotify' => $this->getNotify(),
            'banks' => Bank::all()
        ]);
    }

    public function getDataStructures()
    {
        return view('pages.master-data.structures.index', [
            'organizations' => Organization::all(),
            'structures' => Structure::all(),
            'getNotify' => $this->getNotify(),
        ]);
    }
    public function getManagementShift()
    {
        return view('pages.pegawai.manajemen-shift.index');
    }
    public function dayOffRequest()
    {
        $getNotify = $this->getNotify();
        $day_off_requests = DayOffRequest::all();
        $attendance_code = AttendanceCode::all();
        return view('pages.pengajuan.pengajuan-cuti.index', compact('day_off_requests', 'attendance_code', 'getNotify'));
    }
    public function getDayOffRequest($id)
    {
        $getNotify = $this->getNotify();
        $day_off_requests = DayOffRequest::where('id', $id)->get();
        $attendance_code = AttendanceCode::all();
        return view('pages.pengajuan.pengajuan-cuti.index', compact('day_off_requests', 'attendance_code', 'getNotify'));
    }
}
