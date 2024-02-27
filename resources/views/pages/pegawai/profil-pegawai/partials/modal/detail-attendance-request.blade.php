<div class="modal fade font-weight-bold p-0" id="showDetailAttendanceRequest" tabindex="-2" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="font-weight-bold border-bottom">Detail Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body py-0">
                <div class="font-weight-normal" id="contentModalRequestDetail">
                    <span id="employee_code" class="font-weight-bold"></span> - <span id="employee_name"
                        class="font-weight-bold"></span><br>
                    mengajukan Absensi
                    <br>
                    <span id="requestAttendance" class=""></span> pada <span id="date"
                        class=""></span><br>
                    Catatan: <span id="catatan" class=""></span>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/id.min.js"></script>
<script>
    function getDetail(id) {
        console.log("Kontol");
        let button = $(this);
        button.find('.ikon-edit').hide();
        button.find('.spinner-text').removeClass('d-none');

        $.ajax({
            type: "GET",
            url: `/api/dashboard/attendance-request/get/${id}`,
            dataType: "json",
            success: function(data) {
                let formattedDate = moment(data.attendanceRequest.date).locale('id').format(
                    'dddd, D MMMM YYYY');
                // console.log(data.employee);
                button.find('.ikon-edit').show();
                button.find('.spinner-text').addClass('d-none');
                $('#showDetailAttendanceRequest').modal('show');
                $('#showDetailAttendanceRequest #employee_code').text(data.employee
                    .employee_code);
                $('#showDetailAttendanceRequest #employee_name').text(data.employee
                    .fullname);
                $('#showDetailAttendanceRequest #requestAttendance').text(data
                    .request);
                $('#showDetailAttendanceRequest #date').text(formattedDate);
                $('#showDetailAttendanceRequest #catatan').text(data
                    .attendanceRequest.description);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
</script>
