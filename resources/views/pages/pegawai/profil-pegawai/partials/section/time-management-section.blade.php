    <div class="tab-pane fade" id="v-pills-attendance" role="tabpanel" aria-labelledby="v-pills-attendance-tab">
        <div class="border px-3 pt-3 pb-0 rounded">
            <div class="tab-content py-3">
                <div class="tab-pane fade show active" id="pekerjaan" role="tabpanel">
                    <h3>
                        Absensi
                    </h3>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button data-backdrop="static" data-keyboard="false"
                                        class="badge mx-1 badge-success p-2 border-0 text-white btn-ajukan"
                                        title="Ajukan">
                                        Ajukan Absensi
                                    </button>
                                    <button data-backdrop="static" data-keyboard="false"
                                        class="badge mx-1 badge-success p-2 border-0 text-white" title="Log Absensi">
                                        Lihat Log Absensi
                                    </button>
                                    <a href="{{ route('dashboard') }}"
                                        class="badge mx-1 badge-success p-2 border-0 text-white">
                                        Absensi Langsung
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 mt-5">
                    <thead>
                        <tr>
                            {{-- <th style="white-space: nowrap">Foto</th> --}}
                            <th style="white-space: nowrap">No</th>
                            <th style="white-space: nowrap">Tanggal Dibuat</th>
                            <th style="white-space: nowrap">Tanggal Pengajuan</th>
                            <th style="white-space: nowrap">Status</th>
                            <th style="white-space: nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                {{-- <td style="white-space: nowrap">{{ $user->template_user->foto }}</td> --}}
                                <td style="white-space: nowrap">{{ $loop->iteration }}</td>
                                <td style="white-space: nowrap">{{ $attendance->created_at->translatedFormat('d F Y') }}
                                <td style="white-space: nowrap">
                                    {{ \Carbon\Carbon::parse($attendance->date)->translatedFormat('d F Y') }}
                                </td>
                                <td style="white-space: nowrap">{{ ucfirst($attendance->is_approved) }}
                                <td style="white-space: nowrap">
                                    <button type="button" data-backdrop="static" data-keyboard="false"
                                        class="badge mx-1 badge-primary p-2 border-0 text-white"
                                        onclick="getDetail({{ $attendance->id }})" title="Detail">
                                        <span class="fal fa-eye ikon-edit"></span>
                                        <div class="span spinner-text d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </div>
                                    </button>
                                    <button type="button" data-backdrop="static" data-keyboard="false"
                                        class="badge mx-1 badge-success p-2 border-0 text-white btn-hapus"
                                        data-id="" title="Hapus">
                                        <span class="fal fa-trash ikon-hapus"></span>
                                        <div class="span spinner-text d-none">
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </div>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
