@extends("layouts.app")
@section("mainContent")


<div class="main-card content shadow-sm">
    <div class="warehouse-main">
        <h4 class="wh-title">Rejection Update</h4>
        <div class="card bg-white">
            <div class="table-responsive table-pad">
                <table id="rejectionTable" class="table wh-table table-bordered rejection-update rejectionupdateadmin">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Shift</th>
                            <th>Overall Rejection</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if ($rejectionData)
                            @php $counter = 1 @endphp
                            @foreach ($rejectionData as $rejectionValues)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>
                                        <div class="wh-shift">
                                            <strong>{{ \Carbon\Carbon::parse($rejectionValues["created_at"])->format("D, d M Y") }}</strong>
                                            <br/>{{ \Carbon\Carbon::parse($rejectionValues["shift_from"])->format("d M, H:i") }}
                                            <br>{{ \Carbon\Carbon::parse($rejectionValues["shift_to"])->format("d M, H:i") }}
                                        </div>
                                    </td>
                                    @php
                                        $rejectionArr = json_decode($rejectionValues["rm_pm_stock_rejection_percentage"], true);

                                        $percentages = array_map(function ($value) {
                                            return (float) str_replace('%', '', $value);
                                        }, $rejectionArr);

                                        $average = count($percentages) ? array_sum($percentages) / count($percentages) : 0;
                                    @endphp

                                    <td class="wh-center">{{ number_format($average, 2) }}%</td>
                                    <td>
                                        <div class="wh-card">
                                            <textarea readonly>{{ $rejectionValues["remark"] }}</textarea>
                                        </div>
                                    </td>
                                    <td><span class="wh-status {{ $rejectionValues["approved_status"] == 0 ? 'freeze' : 'running'}}">
                                        {{ $rejectionValues["approved_status"] == 0 ? 'Halted' : 'Approved'}}</span></td>

                                    <td class="wh-action">
                                        <button class="wh-btn edit-btn" onclick="openRejectModal(
                                            {{ $rejectionValues['id'] }}, 
                                            '{{ $rejectionValues['shift_from'] }}',
                                            '{{ $rejectionValues['shift_to'] }}',
                                            '{{ $average }}',
                                            '{{ $rejectionValues['remark'] }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="wh-btn view-btn" onclick="openViewRejectModal({{ $rejectionValues['id'] }})">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="rejectModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content wh-modal">
                <div class="modal-header">
                    <h4>Rejection Action</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ url('rejectionUpdateDo') }}" class="generalformloader" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wh-field">
                                    <label>Shift from</label>
                                    <input type="text" value="08:00" id="shift_from" class="wh-input" readonly/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="wh-field">
                                    <label>Shift to</label>
                                    <input type="text" value="20:00" id="shift_to" class="wh-input" readonly/>
                                </div>
                            </div>
                        </div>

                        <div class="wh-field">
                            <label>Rejection</label>
                            <input type="text" value="2%" id="total_rejection" class="wh-input" readonly/>
                        </div>

                        <div class="wh-field">
                            <label>User Remarks</label>
                            <textarea class="wh-input" id="user_remark" readonly></textarea>
                        </div>
                        <input type="hidden" name="rejection_id" id="rejection_id">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="action" value="approve" class="wh-approve">
                            Approve
                        </button>

                        <button type="submit" name="action" value="reject" class="wh-reject">
                            Reject
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewRejectModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content wh-modal">
                <!-- HEADER -->
                <div class="modal-header">
                    <h4 class="text-center">Rejection Detail</h4>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <!-- OVERALL % -->
                    <div class="wh-overall">
                        <span class="text-white">Overall</span>
                        <button class="wh-overall-btn" id="overallRejectionBtn">0%</button>
                    </div>

                    <!-- MAIN CARD -->
                    <div class="wh-detail-card">
                        <h6 class="wh-card-title">Company Owned Contractor Operated Line</h6>
                        <div class="wh-section">

                            <table class="wh-inner-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody id="rejectionDetailBody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- FOOTER -->
                {{-- <div class="modal-footer wh-footer">
                    <span>Print:</span>
                    <button class="wh-export-btn"><i class="fa fa-file-excel"></i> Excel</button>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {

        $('#rejectionTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true,
            responsive: true
        });

    });

    function openRejectModal(rejectionId, shiftFrom, shiftTo, rejectionPercentage, remark) {

        document.getElementById("shift_from").value = shiftFrom;
        document.getElementById("shift_to").value = shiftTo;
        document.getElementById("total_rejection").value = rejectionPercentage;
        document.getElementById("user_remark").value = remark;
        document.getElementById("rejection_id").value = rejectionId;

        let rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
        rejectModal.show();
    }

</script>

<script>

    function openViewRejectModal(rejectionId) {
        $.ajax({
            url: "{{ url('/getSingleRejectionData') }}",
            type: "GET",
            data: {
                rejectioMasterId: rejectionId
            },
            success: function(response) {
                if (response.status == "success") {
                    let tableBody = "";
                    let totalPercentage = 0;
                    response.data.forEach((item, index) => {
                        let percentage = parseFloat(
                            item.rejection_percentage.replace('%', '')
                        );
                        totalPercentage += percentage;
                        tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.rm_pm_name}</td>
                                <td>${item.rm_pm_cat_name}</td>
                                <td>${item.rejection_percentage}</td>
                            </tr>
                        `;
                    });
                    // Fill table
                    document.getElementById("rejectionDetailBody").innerHTML = tableBody;
                    // Calculate average
                    let average = 0;
                    if (response.data.length > 0) {
                        average = totalPercentage / response.data.length;
                    }
                    // Fill overall rejection
                    document.getElementById("overallRejectionBtn").innerHTML =
                        average.toFixed(2) + "%";
                    // Open modal
                    let viewModal = new bootstrap.Modal(
                        document.getElementById('viewRejectModal')
                    );
                    viewModal.show();
                } else {
                    alert("No Data Available!!");
                }
            },

            error: function(error) {
                console.log(error);
            }
        });
    }

</script>

@endsection