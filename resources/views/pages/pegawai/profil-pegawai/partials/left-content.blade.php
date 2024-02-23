<div class="col-lg-3">
    <div class="card mb-g rounded-top">
        <div class="row no-gutters row-grid">
            <div class="col-12">
                <div class="d-flex flex-column align-items-center justify-content-center p-4">
                    <img src="/img/demo/avatars/avatar-admin-lg.png" class="rounded-circle shadow-2 img-thumbnail"
                        alt="">
                    <h5 class="mb-0 fw-700 text-center mt-3">
                        {{ auth()->user()->name }}
                        <small class="text-muted mb-0">{{ $employee->organization->name }}</small>
                    </h5>
                    <div class="mt-4 text-center demo">
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="accordion accordion-hover" id="info-parent">

                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title" data-toggle="collapse"
                                data-target="#general-info" aria-expanded="true">
                                <i class="fal fa-user-alt width-2 fs-xl"></i>
                                General
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="general-info" class="collapse show" data-parent="#info-parent">
                            <div class="card-body p-0">
                                <div class="nav flex-column row row-grid no-gutters" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link active col-12 p-3" id="v-pills-personal-tab" data-toggle="pill"
                                        href="#v-pills-personal" role="tab" aria-controls="v-pills-personal">
                                        <span class="hidden-sm-down ml-1">Info Personal</span>
                                    </a>
                                    <a class="nav-link col-12 p-3" id="v-pills-pekerjaan-tab" data-toggle="pill"
                                        href="#v-pills-pekerjaan" role="tab" aria-controls="v-pills-pekerjaan">
                                        <span class="hidden-sm-down ml-1">Info Pekerjaan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse"
                                data-target="#time-management-info" aria-expanded="false">
                                <i class="fal fa-clock width-2 fs-xl"></i>
                                Manajemen Waktu
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="time-management-info" class="collapse" data-parent="#info-parent">
                            <div class="card-body p-0">
                                <div class="nav flex-column row row-grid no-gutters" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <a class="nav-link col-12 p-3" id="v-pills-attendance-tab" data-toggle="pill"
                                        href="#v-pills-attendance" role="tab" aria-controls="v-pills-attendance">
                                        <span class="hidden-sm-down ml-1">Absensi</span>
                                    </a>
                                    <a class="nav-link col-12 p-3" id="v-pills-time-off-tab" data-toggle="pill"
                                        href="#v-pills-time-off" role="tab" aria-controls="v-pills-time-off">
                                        <span class="hidden-sm-down ml-1">Libur</span>
                                    </a>
                                    <a class="nav-link col-12 p-3" id="v-pills-overtime-tab" data-toggle="pill"
                                        href="#v-pills-overtime" role="tab" aria-controls="v-pills-overtime">
                                        <span class="hidden-sm-down ml-1">Lembur</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse"
                                data-target="#js_demo_accordion-5c" aria-expanded="false">
                                <i class="fab fa-buromobelexperte width-2 fs-xl"></i>
                                Payroll
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="js_demo_accordion-5c" class="collapse" data-parent="#js_demo_accordion-5">
                            <div class="card-body p-0">
                                <div class="col-12 p-3">
                                    <a href="#" class="d-block w-100">Payroll Info</a>
                                </div>
                                <div class="col-12 p-3">
                                    <a href="#" class="d-block w-100">Payslip</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse"
                                data-target="#js_demo_accordion-5d" aria-expanded="false">
                                <i class="fal fa-money-bill-alt width-2 fs-xl"></i>
                                Finance
                                <span class="ml-auto">
                                    <span class="collapsed-reveal">
                                        <i class="fal fa-chevron-up fs-xl"></i>
                                    </span>
                                    <span class="collapsed-hidden">
                                        <i class="fal fa-chevron-down fs-xl"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <div id="js_demo_accordion-5d" class="collapse" data-parent="#js_demo_accordion-5">
                            <div class="card-body p-0">
                                <div class="col-12 p-3">
                                    <a href="#" class="d-block w-100">Reimbursement</a>
                                </div>
                                <div class="col-12 p-3">
                                    <a href="#" class="d-block w-100">Loan</a>
                                </div>
                                <div class="col-12 p-3">
                                    <a href="#" class="d-block w-100">Cash Advance</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
