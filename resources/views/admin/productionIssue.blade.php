@extends("layouts.app")

@section("mainContent")

<div class="main-card content shadow-sm">
    <div class="production-issue">
        <h4 class="text-center mb-3">Production Issues</h4>
        <div class="card bg-white">
            <div class="table-responsive">
                <table class="table production-table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Issue Type</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- ROW 1 -->
                        <tr>
                            <td>1</td>
                            <td>28/04/2026</td>
                            <td>Labour / Staff</td>
                            <td>
                                <textarea class="pi-textarea" readonly>
                                    Lorem ipsum dolor sit amet...</textarea>
                            </td>
                            <td><span class="badge bg-success">Approved</span></td>
                            <td>
                                <button class="pi-btn edit" data-bs-toggle="modal" data-bs-target="#issueModal">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="pi-btn delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- ROW 2 -->
                        <tr>
                            <td>2</td>
                            <td>29/04/2026</td>
                            <td>Machine Problem</td>
                            <td>
                                <textarea class="pi-textarea" readonly>
                                    Machine breakdown due to overload...</textarea>
                            </td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                            <td>
                                <button class="pi-btn edit" data-bs-toggle="modal" data-bs-target="#issueModal">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="pi-btn delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- ROW 3 -->
                        <tr>
                            <td>3</td>
                            <td>30/04/2026</td>
                            <td>Light Problem</td>
                            <td>
                                <textarea class="pi-textarea" readonly>
                                    Lighting issue in production area...</textarea>
                            </td>
                            <td><span class="badge bg-danger">Rejected</span></td>
                            <td>
                                <button class="pi-btn edit" data-bs-toggle="modal" data-bs-target="#issueModal">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="pi-btn delete">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
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
</div>

@endsection