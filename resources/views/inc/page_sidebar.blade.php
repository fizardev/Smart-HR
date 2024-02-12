<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo d-flex justify-content-center text-center">
        <a href="#"
            class="page-logo-link press-scale-down d-flex align-items-center justify-content-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('storage/img/logo.png') }}" alt="Laravel" aria-roledescription="logo" style="width: 45px">
            <span class="page-logo-text font-weight-bold">SMART HR</span>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                    tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="/img/demo/avatars/avatar-admin.png" class="profile-image rounded-circle"
                alt="{{ auth()->user()->name }}">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        {{ auth()->user()->name }}
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Majalengka, Jawa Barat</span>
            </div>
            <img src="/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li class="{{ set_active('dashboard') }}">
                <a href="/dashboard" title="Dashboard" data-filter-tags="application dashboard">
                    <i class='bx bxs-dashboard'></i>
                    <span class="nav-link-text" data-i18n="nav.application_dashboard">Dashboard</span>
                </a>
            </li>
            {{-- <li class="{{ set_active('users') }}">
                <a href="{{ route('user.index') }}" title="users" data-filter-tags="application user">
                    <i class='bx bxs-user-account'></i>
                    <span class="nav-link-text" data-i18n="nav.application_user">Users</span>
                </a>
            </li> --}}
            <li
                class="{{ set_active_mainmenu(['dashboard/employees', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                <a href="#" title="Settings" data-filter-tags="application user">
                    <i class='bx bxs-user-detail'></i>
                    <span class="nav-link-text" data-i18n="nav.application_user">Pegawai</span>
                </a>
                <ul>
                    <li
                        class="{{ set_active(['dashboard/employees', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                        <a href="/dashboard/employees" title="Analytics settings"
                            data-filter-tags="dashboard settings employees pegawai perusahaan profile">
                            <span class="nav-link-text" data-i18n="nav.application_employees">Daftar Pegawai</span>
                        </a>
                    </li>
                    <li
                        class="{{ set_active(['dashboard/company', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                        <a href="/dashboard/company" title="Analytics settings"
                            data-filter-tags="dashboard settings company perusahaan profile">
                            <span class="nav-link-text" data-i18n="nav.application_company">Kehadiran</span>
                        </a>
                    </li>
                    <li
                        class="{{ set_active(['dashboard/company', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                        <a href="/dashboard/company" title="Analytics settings"
                            data-filter-tags="dashboard settings company perusahaan profile">
                            <span class="nav-link-text" data-i18n="nav.application_company">Gaji Pegawai</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li
                class="{{ set_active_mainmenu(['dashboard/company', 'dashboard/day-off', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                <a href="#" title="Settings" data-filter-tags="application user">
                    <i class='bx bx-cube'></i>
                    <span class="nav-link-text" data-i18n="nav.application_user">Master Data</span>
                </a>
                <ul>
                    <li
                        class="{{ set_active_mainmenu(['dashboard/company', 'dashboard/organizations', 'dashboard/job-level', 'dashboard/job-position']) }}">
                        <a href="#" title="Application Intel" data-filter-tags="application intel">
                            <i class="fas fa-building"></i>
                            <span class="nav-link-text" data-i18n="nav.application_intel">Perusahaan</span>
                        </a>
                        <ul>
                            <li class="{{ set_active('dashboard/company') }}">
                                <a href="/dashboard/company" title="Analytics settings"
                                    data-filter-tags="dashboard settings company perusahaan profile">
                                    <span class="nav-link-text" data-i18n="nav.application_company">Profile</span>
                                </a>
                            </li>
                            <li class="{{ set_active('dashboard/organizations') }}">
                                <a href="/dashboard/organizations" title="Organisasi Perusahaan"
                                    data-filter-tags="dashboard settings organisasi perusahaan organisasi">
                                    <span class="nav-link-text"
                                        data-i18n="nav.application_organization">Organisasi</span>
                                </a>
                            </li>
                            <li class="{{ set_active('dashboard/job-level') }}">
                                <a href="{{ route('job-level') }}" title="Organisasi Perusahaan"
                                    data-filter-tags="dashboard settings  company perusahaan job level">
                                    <span class="nav-link-text" data-i18n="nav.application_company">Job Level</span>
                                </a>
                            </li>
                            <li class="{{ set_active('dashboard/job-position') }}">
                                <a href="/dashboard/job-position" title="Organisasi Perusahaan"
                                    data-filter-tags="dashboard settings  perusahaan job position">
                                    <span class="nav-link-text" data-i18n="nav.application_job-position">Job
                                        Position</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="{{ set_active_mainmenu(['dashboard/time-management', 'dashboard/day-off', 'dashboard/attendance-codes', 'dashboard/shifts']) }}">
                        <a href="#" title="Application Intel" data-filter-tags="application intel">
                            <i class="fas fa-clock"></i>
                            <span class="nav-link-text" data-i18n="nav.application_intel">Manajemen Waktu</span>
                        </a>
                        <ul>
                            <li class="{{ set_active('dashboard/day-off') }}">
                                <a href="/dashboard/day-off" title="Analytics settings"
                                    data-filter-tags="dashboard settings manajemen waktu hari libur">
                                    <span class="nav-link-text" data-i18n="nav.application_company">Hari Libur</span>
                                </a>
                            </li>
                            <li class="{{ set_active('dashboard/attendance-codes') }}">
                                <a href="/dashboard/attendance-codes" title="Organisasi Perusahaan"
                                    data-filter-tags="dashboard settings waktu manajemen kode presensi">
                                    <span class="nav-link-text" data-i18n="nav.application_organization">Kode
                                        Presensi</span>
                                </a>
                            </li>
                            <li class="{{ set_active('dashboard/shifts') }}">
                                <a href="#" title="Organisasi Perusahaan"
                                    data-filter-tags="dashboard settings  shift waktu">
                                    <span class="nav-link-text" data-i18n="nav.application_company">Manajemen
                                        Shift</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
            class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                    <i class="fal fa-life-ring"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->
