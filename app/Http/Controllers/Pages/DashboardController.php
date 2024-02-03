<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\JobLevel;
use App\Models\Organization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function  getDataOrganization()
    {
        $organizations = Organization::all();
        return view('pages.master-data.organization.index', [
            'organizations' => $organizations,
        ]);
    }

    public function getDataJobLevel()
    {
        return view('pages.master-data.job-level.index', [
            'jobLevel' => JobLevel::all(),
        ]);
    }
}
