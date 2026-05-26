@extends("layouts.app")
@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="production-issue">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0">Production Issues</h5>

            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
                Create
            </button>
        </div>
        <div class="card bg-white">
            <div class="table-responsive">
                <table class="table production-table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Issue Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($productionIssueData)
                            @php $counter = 1 @endphp
                            @foreach ($productionIssueData as $pData)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $pData["production_issue_types"] }}</td>
                                    
                                    <td><span class="badge bg-{{ $pData["is_active"] == 1 ? 'success' : 'danger' }}">{{ $pData["is_active"] == 1 ? 'Active' : 'Inactive' }}</span></td>
                                    <td>
                                        <button class="pi-btn edit" data-bs-toggle="modal" data-bs-target="#issueModal">
                                            <i class="fa fa-pen"></i>
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
    <div class="modal fade" id="issueModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pi-modal">
                <!-- HEADER -->
                <div class="modal-header justify-content-center">
                    <h5 class="w-100 text-center">Action</h5>
                    <button class="btn-close position-absolute end-0 me-2" data-bs-dismiss="modal"></button>
                </div>

                <!-- BODY -->
                <div class="modal-body">
                    <div class="pi-field">
                        <label>Date</label>
                        <input type="text" class="custom-field form-control" value="28/04/2026" />
                    </div>

                    <div class="pi-field">
                        <label>Issue Type</label>
                        <input type="text" class="custom-field form-control" value="Labour / Staff" />
                    </div>

                    <div class="pi-field">
                        <label>User Remarks</label>
                        <textarea class="custom-field form-control">Lorem ipsum dolor sit amet...</textarea>
                    </div>

                    <button class="pi-mail-btn"><i class="fa fa-envelope"></i> Send Email</button>
                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button class="btn btn-primary">Approve</button>
                    <button class="btn btn-danger">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="createModal">
        <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5>Generate Order Now</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ url("productionIssueDo") }}" class="generalformloader" method="post">
                        @csrf
                        <div class="modal-body">
                            <label>Issue Type</label>
                            <input name="issue_type" type="text" class="form-control mb-3" required>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</div>

@endsection