@extends("layouts.app")

@section("mainContent")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<div class="main-card content shadow-sm">
    <div id="users">
        <div class="card bg-white">
            <div class="card-header">
                <h4>Shift Report</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="shiftReport"> 
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Email</th>
                                <th>Shift From</th>
                                <th>Shift To</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($shiftData)
                                @php $counter = 1 @endphp
                                @foreach ($shiftData as $rData)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $rData["email"] }}</td>
                                        <td>{{ $rData["shift_from"] }}</td>
                                        <td>{{ $rData["shift_to"] }}</td>
                                        <td>{{ $rData["shift_over_status"] == 1 ? "Inactive" : "Active" }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
                
    $(document).ready(function () {

        $('#shiftReport').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            ordering: true,
            searching: true,
            scrollX: true,
            columnDefs: [
                {
                    orderable: true,
                    targets: [0]
                }
            ]
        });

    });

</script>


@endsection