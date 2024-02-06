<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\JobLevel;
use App\Models\JobPosition;
use App\Models\Organization;
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
        ]);
    }
}
