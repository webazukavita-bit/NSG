@extends('front.layouts.dashboard')
@section('main')

<main class="container py-2">
    <!-- Title Section -->
    {{-- <div class="text-center mb-4">
        <h3 class="fw-bold">MONTHLY PERFORMANCE OVERVIEW</h3>
        <p class="text-muted fs-5">For January 2026</p>
    </div> --}}

    <!-- Stats Grid -->
    <div class="row g-4 mb-3">
        <!-- City-Wise Ranking -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0">Today Orders</h3>
                </div>
                <div class="stat-box">
                    <p class="small text-muted mb-2">Today Orders</p>
                    <p class="display-6 fw-bold text-primary mb-0">{{$todayorder}}</p>
                </div>
            </div>
        </div>

        <!-- State-Wise Ranking -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0">Total Balance</h3>
                    <svg class="text-danger" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </div>
                
                <div class="stat-box">
                    <p class="small text-muted mb-2">Your wallet balance</p>
                    <p class="display-6 fw-bold text-primary mb-0">{{Auth::user()->wallet->main_balance ?? '-'}}</p>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 fw-bold text-danger mb-0"> Total Order Summary</h3>
                    <svg class="text-danger" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </div>
                
                <div class="stat-box ">
                    <p class="small text-muted mb-2">Total Orders</p>
                    <p class="display-6 fw-bold text-primary mb-0">{{$orderCount}}</p>
                </div>
                
              
            </div>
        </div>
    </div>

	<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body">
                        
						<div class="card-title d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bx bxs-file me-1 font-22 text-primary"></i>
                                <h5 class="mb-0 text-primary"> Your Orders</h5>
                            </div>
							<div>
                                {{-- <a href="{{ route('shop') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Order</a> --}}
                            </div>
                        </div>
                        <hr>
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
                                        <th>Sn.</th>
										<th>Order Id</th>
										<th>User Name</th>
										<th> Order Status</th>
										<th>Total</th>
										<th>Payment Status</th>
										<th>Payment Method</th>
										<th>Date</th>
                                        {{-- <th>View Details</th> --}}
									</tr>
								</thead>
                                	@php
		$profile = 'images/user-1.svg';
	@endphp

								<tbody>
									@foreach ($order as $key=> $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
										<td>{{ $value->code ?? '' }}</td>
										<td><div class="d-flex align-items-center">
                                    <img src="{{ asset('images/profile/' .($value->user->image ?? '') ) }}" onerror="this.onerror=null;this.src='{{ asset($profile) }}';" class="product-img-2" alt="product img" style="margin-right: 8px; height:50px;border-radius:10px;"> 
                                    <span>{{ $value->user->name ?? '' }} <br>{{ $value->user->phone_number ?? '' }}  </span></div>
                                        </td>
										<td>
                                         <div class="badge rounded-pill  bg-light-info p-2 text-uppercase px-3"  style="color: {{ $value->status->color ?? '' }};"><i class="bx bxs-circle align-middle me-1"></i>{{$value->status->name ?? ''}}</div></td>
										<td>{{ $value->final_amount_with_tax ?? '-'}}</td>
										<td  style="color: {{ $value->paymentStatus->color ?? '' }};font-weight:500;"><i class="bx bxs-circle align-middle me-1"></i>{{ $value->paymentStatus->name ?? '-'}}</td>
										<td>{{ $value->payment_method ?? 'Wallet'}}</td>
										<td>{{ $value->updated_at }}</td>
										{{-- <td><a href="{{route('show-invoice',['id'=>$value->id])}}" type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</a></td> --}}
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>




    <!-- Business Activity Level -->
    {{-- <div class="stat-card mb-4">
        <div class="text-center">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <h3 class="h4 fw-bold text-danger me-3 mb-0">Business Activity Level</h3>
                <svg class="text-danger" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                </svg>
            </div>
            
            <div class="my-4">
                <p class="display-1 fw-bold text-success fst-italic mb-0">High</p>
            </div>
            
            <div class="mx-auto" style="max-width: 768px;">
                <p class="fs-5 fw-semibold text-dark mb-2">Compared with All Printers Across India</p>
                <p class="small text-muted">(This performance is based on December 2025 business activity data analyzed through our AI-powered performance evaluation tool. We compare your order volume, frequency, and value against all active printers nationwide to provide you with this ranking.)</p>
            </div>

            <!-- Activity Badge -->
            <div class="mt-4">
                <div class="activity-badge">
                    <span class="pulse-dot"></span>
                    <span class="text-success fw-semibold">Active Business Performance</span>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Quick Actions -->

</main>

@endsection