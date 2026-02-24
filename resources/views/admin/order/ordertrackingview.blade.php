
@extends('admin.layouts.app')
@section('content')



		<!-- Order Summary -->
		<div class="row mb-4">
			<div class="col-md-6">
				<h6 class="text-secondary mb-3"><strong>Order Information</strong></h6>
				<table class="table table-borderless">
					<tbody>
						<tr>
							<td class="ps-0"><strong>Order ID:</strong></td>
							<td class="text-end pe-0">{{ $order->code }}</td>
						</tr>
						<tr>
							<td class="ps-0"><strong>Customer:</strong></td>
							<td class="text-end pe-0">{{ $order->user->name ?? 'N/A' }}</td>
						</tr>
						<tr>
							<td class="ps-0"><strong>Amount:</strong></td>
							<td class="text-end pe-0">₹ {{ number_format($order->final_amount_with_tax, 2) }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<h6 class="text-secondary mb-3"><strong>Status Information</strong></h6>
				<table class="table table-borderless">
					<tbody>
						<tr>
							<td class="ps-0"><strong>Order Status:</strong></td>
							<td class="text-end pe-0">
								<span class="badge bg-light-info p-2 text-uppercase" style="color: {{ $order->status->color ?? '#666' }};">
									<i class="bx bxs-circle align-middle me-1"></i>{{ $order->status->name ?? 'N/A' }}
								</span>
							</td>
						</tr>
						<tr>
							<td class="ps-0"><strong>Payment Status:</strong></td>
							<td class="text-end pe-0">
								<span class="badge bg-light-warning p-2" style="color: {{ $order->paymentStatus->color ?? '#666' }};">
									<i class="bx bxs-circle align-middle me-1"></i>{{ $order->paymentStatus->name ?? 'N/A' }}
								</span>
							</td>
						</tr>
						<tr>
							<td class="ps-0"><strong>Order Date:</strong></td>
							<td class="text-end pe-0">{{ $order->created_at }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<hr>

		<!-- Tracking Logs Timeline -->
		<h6 class="text-secondary mb-4"><strong>Tracking History</strong></h6>
		
		@if($trackingLogs->count() > 0)
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead class="table-light">
						<tr>
							<th width="5%">#</th>
							<th width="20%">Status/Remark</th>
							<th width="35%">Description</th>
							<th width="15%">Assigned To</th>
							<th width="15%">Department</th>
							<th width="15%">Date & Time</th>
						</tr>
					</thead>
					<tbody>
						@foreach($trackingLogs as $key => $log)
							<tr>
								<td>
									<span class="badge bg-primary text-white">{{ $trackingLogs->count() - $key }}</span>
								</td>
								<td>
									<strong>{{ $log->status ?? 'N/A' }}</strong>
									@if($log->remark)
										<br>
										<small class="text-muted">Remark: {{ $log->remark }}</small>
									@endif
								</td>
								<td>
									<small class="text-secondary">
										{{ Str::limit($log->remark ?? 'No description', 50) }}
									</small>
								</td>
								<td>
									@if($log->assignedTo)
										<span class="badge bg-info text-white">{{ $log->assignedTo->name }}</span>
									@else
										<span class="text-muted">-</span>
									@endif
								</td>
								<td>
									@if($log->department)
										<small class="text-secondary">{{ $log->department }}</small>
									@else
										<span class="text-muted">-</span>
									@endif
								</td>
								<td>
									<small>{{ $log->created_at ?? 'N/A' }}</small>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<!-- Timeline View Alternative -->
			<div class="mt-5">
				<h6 class="text-secondary mb-4"><strong>Timeline View</strong></h6>
				<div class="timeline-container">
					@foreach($trackingLogs as $key => $log)
						<div class="timeline-item mb-4">
							<div class="timeline-marker {{ $key == 0 ? 'active' : '' }}">
								<span class="timeline-dot {{ $key == 0 ? 'bg-success' : 'bg-secondary' }}"></span>
							</div>
							<div class="timeline-content ps-3">
								<h6 class="mb-1">
									<strong>{{ $log->status ?? 'Status Update' }}</strong>
									<span class="text-muted float-end small">{{ $log->created_at }}</span>
								</h6>
								<p class="text-muted mb-2">{{ $log->remark ?? 'No description provided' }}</p>
								@if($log->assignedTo || $log->department)
									<small class="text-secondary">
										@if($log->assignedTo)
											Assigned to: <strong>{{ $log->assignedTo->name }}</strong>
										@endif
										@if($log->department)
											 | Department: <strong>{{ $log->department }}</strong>
										@endif
									</small>
								@endif
							</div>
						</div>
					@endforeach
				</div>
			</div>

		@else
			<div class="alert alert-info" role="alert">
				<i class="bx bx-info-circle me-2"></i>
				No tracking logs available for this order yet.
			</div>
		@endif
	</div>
</div>

<style>
	.timeline-container {
		position: relative;
		padding-left: 30px;
	}

	.timeline-container::before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		bottom: 0;
		width: 2px;
		background: linear-gradient(to bottom, #007bff, #28a745);
	}

	.timeline-item {
		position: relative;
	}

	.timeline-marker {
		position: absolute;
		left: -42px;
		top: 0;
	}

	.timeline-dot {
		display: inline-block;
		width: 16px;
		height: 16px;
		border-radius: 50%;
		border: 3px solid #fff;
		box-shadow: 0 0 0 3px #dee2e6;
	}

	.timeline-dot.bg-success {
		background-color: #28a745 !important;
		box-shadow: 0 0 0 3px #28a745, 0 0 0 6px #fff;
	}

	.timeline-content {
		background-color: #f8f9fa;
		padding: 15px;
		border-radius: 5px;
		border-left: 3px solid #007bff;
	}

	.timeline-item:first-child .timeline-content {
		border-left-color: #28a745;
		background-color: #f0f8f5;
	}
</style>

@endsection
