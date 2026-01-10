@extends('front.layouts.dashboard')

@section('main')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">


@php
    $profile = 'images/user-1.svg';
@endphp

<!-- Page Header -->
<div class="fw-bold">
  
</div>

<!-- Main Card -->
<div class="card-custom mt-5">
    <div class="card-body mt-4">
        <!-- Export Buttons -->
        <div class="mb-3 d-flex flex-wrap gap-2 export-buttons bg-primary" style="border-radius: 10px;">
            <h4 class="text-white py-2 px-2"><i class="bx bxs-wallet me-2 "></i>Fund Request List</h4>
        </div>

        <div class="table-wrapper table-responsive">
            <table id="example" class="table table-hover nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Sn.</th>
                        <th>User Details</th>
                        <th>Contact</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Receipt</th>
                        <th>User Remark</th>
                        <th>Admin Remark</th>
                        <th>Status</th>
                        <th>Date</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td><strong>{{$key+1}}</strong></td>
                        <td>
                            <div class="user-info-cell">
                                <img src="{{ asset('images/profile/' . $value->fromUser->image) }}" 
                                     onerror="this.onerror=null;this.src='{{ asset($profile) }}';" 
                                     class="user-avatar" 
                                     alt="User Avatar"> 
                                <div class="user-details">
                                    <p class="user-name">{{ $value->fromUser->name }}</p>
                                    <p class="user-code">{{ $value->fromUser->code }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>
                                <div><i class="bx bx-envelope me-1"></i>{{$value->fromUser->email}}</div>
                                <div class="text-muted"><i class="bx bx-phone me-1"></i>{{$value->fromUser->phone_number}}</div>
                            </div>
                        </td>
                        <td><span class="transaction-id">{{$value->trans_id}}</span></td>
                        <td><span class="amount-cell">₹{{number_format($value->amount, 2)}}</span></td>
                        <td>
                            <img src="{{ asset('images/fund_request/' . $value->utr_img) }}"
                                 class="image-thumbnail"
                                 onclick="showImageModal('{{ asset('images/fund_request/' . $value->utr_img) }}')"
                                 alt="Receipt">
                        </td>
                        <td>
                            <span class="text-muted">{{$value->desc ?: 'N/A'}}</span>
                        </td>
                        <td>
                            <span class="text-muted">{{$value->remark ?: 'N/A'}}</span>
                        </td>
                        <td>
                            @if($value->status == 'Pending')
                                <span class="status-badge status-pending">Pending</span>
                            @elseif($value->status == 'Approved')
                                <span class="status-badge status-approved">Approved</span>
                            @else
                                <span class="status-badge status-rejected">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{date('d M Y', strtotime($value->created_at))}}<br>{{date('h:i A', strtotime($value->created_at))}}</small>
                        </td>
                        {{-- <td>
                            @if($value->status == 'Pending')
                                @php
                                    $urlv = route('fund-request-update',['type' => 'verify', 'id' => $value->id]);
                                    $urlr = route('fund-request-update',['type' => 'reject', 'id' => $value->id]);
                                @endphp
                                <div class="d-flex gap-2">
                                    <button class="action-btn action-btn-success" 
                                            onclick="openModal('{{ $urlv }}', '{{ $value->fromUser->name }}', 'verify')" 
                                            title="Approve Request">
                                        <i class="bx bx-check"></i>
                                    </button>
                                    <button class="action-btn action-btn-danger" 
                                            onclick="openModal('{{ $urlr }}', '{{ $value->fromUser->name }}', 'reject')" 
                                            title="Reject Request">
                                        <i class="bx bx-x"></i>
                                    </button>
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td> --}}
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Remark Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <form id="idForm" action="" method="GET">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bx bx-message-square-detail me-2"></i>
                        Fund Request <span id="kyc-statuss" class="text-uppercase"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Enter remark for <strong id="kyc-status"></strong> <strong id="rejectUserName" class="text-primary"></strong>:</p>
                    <textarea name="remarks" class="form-control" rows="3" placeholder="Enter your remarks here..." required></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="bx bx-check me-1"></i>Save
                    </button>
                    <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">
                        <i class="bx bx-x me-1"></i>Close
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <div class="modal-body text-center p-0">
                <span class="close-btn position-absolute top-0 end-0 m-3" 
                      data-bs-dismiss="modal" 
                      aria-label="Close"
                      style="z-index: 1000;">
                    <i class="bx bx-x fs-4"></i>
                </span>
                <img id="modalImage" src="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
    function openModal(url, userName, status) {
        $('#kyc-statuss').text(status);
        $('#kyc-status').text(status=='verify'?'Verifying':'Rejecting');
        $('#rejectUserName').text(userName);
        $('#idForm').attr('action', url); 
        $('#rejectModal').modal('show');
    }

    function showImageModal(imageUrl) {
        $('#modalImage').attr('src', imageUrl);
        $('#imageModal').modal('show');
    }

    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            lengthChange: true,
            autoWidth: false,
            buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
            order: [[0, 'desc']],
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "Showing 0 to 0 of 0 entries",
                infoFiltered: "(filtered from _MAX_ total entries)",
                zeroRecords: "No matching records found",
                emptyTable: "No data available in table",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            columnDefs: [
                {
                    targets: [5, 10], // Image and Action columns
                    orderable: false,
                    searchable: false
                },
                {
                    targets: '_all',
                    className: 'dt-body-center'
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function() {
                // Reinitialize tooltips after table redraw
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });

        table.buttons().container().hide();

        $('.buttons-copys').on('click', () => table.button('.buttons-copy').trigger());
        $('.buttons-excels').on('click', () => table.button('.buttons-excel').trigger());
        $('.buttons-pdfs').on('click', () => table.button('.buttons-pdf').trigger());
        $('.buttons-csvs').on('click', () => table.button('.buttons-csv').trigger());
        $('.buttons-prints').on('click', () => table.button('.buttons-print').trigger());
    });

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
@endpush