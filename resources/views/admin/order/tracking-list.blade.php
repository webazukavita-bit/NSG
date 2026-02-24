@extends('admin.layouts.app')
@section('content')



<div class="card border-top border-0 border-4 border-primary">
	<div class="card-body">
		<div class="card-title d-flex align-items-center justify-content-between">
			<div class="d-flex align-items-center">
				<i class="bx bxs-file me-1 font-22 text-primary"></i>
				<h5 class="mb-0 text-primary">All Orders Tracking</h5>
			</div>
			<div>
				<a href="{{ route('orderes') }}" class="btn btn-secondary"><i class="bx bx-arrow-back"></i> Back to Orders</a>
			</div>
		</div>
		<hr>

		@if($orders->count() > 0)
			<div class="table-responsive">
				<table id="orderTrackingTable" class="table table-striped table-bordered" style="width:100%">
					<thead class="table-light">
						<tr>
							<th width="5%">#</th>
							<th width="12%">Order ID</th>
							<th width="15%">Customer</th>
							<th width="12%">Amount</th>
							<th width="12%">Order Status</th>
							<th width="12%">Payment Status</th>
							<th width="15%">Last Update</th>
							<th width="17%">Recent Activity</th>
							<th width="10%">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $key => $order)
							@php
								$lastLog = $order->trackingLogs()->latest()->first();
							@endphp
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>
									<strong class="text-primary">{{ $order->code }}</strong>
								</td>
								<td>
									<div class="d-flex align-items-center">
										<img src="{{ asset('images/profile/' . ($order->user->image ?? '')) }}" 
											 onerror="this.onerror=null;this.src='{{ asset('images/user-1.svg') }}';" 
											 class="product-img-2" alt="user" style="margin-right: 8px; height: 40px; border-radius: 50%;">
										<div>
											<strong>{{ $order->user->name ?? 'N/A' }}</strong><br>
											<small class="text-muted">{{ $order->user->phone_number ?? '-' }}</small>
										</div>
									</div>
								</td>
								<td>
									<strong>₹ {{ number_format($order->final_amount_with_tax, 2) }}</strong>
								</td>
								<td>
									<span class="badge p-2 text-uppercase" style="background-color: #f0f8ff; color: {{ $order->status->color ?? '#007bff' }};">
										<i class="bx bxs-circle align-middle me-1"></i>{{ $order->status->name ?? 'N/A' }}
									</span>
								</td>
								<td>
									<span class="badge p-2" style="background-color: #fff8e1; color: {{ $order->paymentStatus->color ?? '#ff9800' }};">
										<i class="bx bxs-circle align-middle me-1"></i>{{ $order->paymentStatus->name ?? 'N/A' }}
									</span>
								</td>
								<td>
									<small>
										@if($lastLog)
											{{ $lastLog->created_at }}
										@else
											{{ $order->updated_at }}
										@endif
									</small>
								</td>
								<td>
									<small class="text-muted">
										@if($lastLog)
											<strong>{{ $lastLog->status ?? 'N/A' }}</strong><br>
											{{ Str::limit($lastLog->remark ?? 'No description', 40) }}
										@else
											No activity recorded
										@endif
									</small>
								</td>
								<td>
									<div class="btn-group" role="group">
										<a href="{{ route('order-tracking', ['id' => $order->id]) }}" 
										   class="btn btn-info btn-sm" 
										   data-bs-toggle="tooltip" 
										   title="View Tracking Details">
											<i class="bx bx-time"></i> Tracking
										</a>
										<a href="{{ route('show-invoice', ['id' => $order->id]) }}" 
										   class="btn btn-primary btn-sm" 
										   data-bs-toggle="tooltip" 
										   title="View Invoice">
											<i class="bx bx-file"></i>
										</a>
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>

			<!-- Expanded Details View Below Table -->
			<div class="mt-5">
				<h6 class="text-secondary mb-4"><strong>Detailed Tracking Timeline</strong></h6>
				
				@foreach($orders as $order)
					<div class="accordion mb-4" id="accordion{{ $order->id }}">
						<div class="accordion-item border rounded">
							<h2 class="accordion-header" id="heading{{ $order->id }}">
								<button class="accordion-button collapsed d-flex justify-content-between align-items-center" 
										type="button" 
										data-bs-toggle="collapse" 
										data-bs-target="#collapse{{ $order->id }}" 
										aria-expanded="false" 
										aria-controls="collapse{{ $order->id }}">
									<span>
										<strong class="text-primary">{{ $order->code }}</strong> - {{ $order->user->name }}
										<span class="ms-3 badge bg-light" style="color: {{ $order->status->color ?? '#666' }};">{{ $order->status->name ?? 'N/A' }}</span>
									</span>
									<small class="text-muted">{{ $order->trackingLogs->count() }} updates</small>
								</button>
							</h2>
							<div id="collapse{{ $order->id }}" 
								 class="accordion-collapse collapse" 
								 aria-labelledby="heading{{ $order->id }}" 
								 data-bs-parent="#accordion{{ $order->id }}">
								<div class="accordion-body p-3">
									@if($order->trackingLogs->count() > 0)
										<div class="timeline-container ps-3">
											@foreach($order->trackingLogs->sortByDesc('created_at') as $log)
												<div class="timeline-item mb-3">
													<div class="timeline-marker">
														<span class="timeline-dot bg-primary"></span>
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
																	<strong>Assigned to:</strong> {{ $log->assignedTo->name }}
																@endif
																@if($log->department)
																	 | <strong>Dept:</strong> {{ $log->department }}
																@endif
															</small>
														@endif
													</div>
												</div>
											@endforeach
										</div>
									@else
										<div class="alert alert-info mb-0" role="alert">
											No tracking logs available for this order.
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>

		@else
			<div class="alert alert-info" role="alert">
				<i class="bx bx-info-circle me-2"></i>
				No orders available.
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
		width: 14px;
		height: 14px;
		border-radius: 50%;
		border: 3px solid #fff;
		box-shadow: 0 0 0 3px #dee2e6;
	}

	.timeline-content {
		background-color: #f8f9fa;
		padding: 12px;
		border-radius: 5px;
		border-left: 3px solid #007bff;
	}

	.product-img-2 {
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}
</style>

<script>
	// Initialize DataTable for better sorting/filtering
	$(document).ready(function() {
		$('#orderTrackingTable').DataTable({
			"order": [[6, "desc"]], // Sort by last update column
			"pageLength": 25,
			"language": {
				"emptyTable": "No orders found",
				"zeroRecords": "No matching records found"
			}
		});
	});
</script>

@endsection
