@extends('admin.layouts.app')
@section('content')
   	@php
		$profile = 'images/user-1.svg';
	@endphp

	<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-0">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button text-primary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        <i class="bx bx-filter-alt font-18 text-primary me-1"></i> Filter
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <form action="{{ route('orderes') }}" method="GET" class="row g-3">
                            @csrf

                            <div class="col-md-4">
                                <label for="user_id" class="form-label">User</label>
                                <select name="user_id" id="user_id"
                                    class="form-select @error('user_id') is-invalid @enderror">
                                    <option selected disabled>Choose...</option>
<<<<<<< HEAD
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
=======
                                    @foreach ($order as $ord)
                                        <option value="{{ $ord->user->id ?? '' }}">
                                            {{ $ord->user->name ?? '' }}
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="status_id" class="form-label">Order Status</label>
                                <select name="status_id" id="status_id"
                                    class="form-select @error('status_id') is-invalid @enderror">
<<<<<<< HEAD
                                    <option value="">Choose...</option>
                                    @foreach ($orderstatus as $status)
                                        <option value="{{ $status->id }}" {{ request('status_id') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
=======
                                    <option selected disabled>Choose...</option>
                                    @foreach ($orderstatus as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                                    @endforeach
                                </select>
                                @error('status_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                           
                            <div class="col-12 text-center mt-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bx bx-search"></i> Filter
                                </button>
<<<<<<< HEAD
                                @if(request('user_id') || request('status_id'))
                                    <a href="{{ route('orderes') }}" class="btn btn-secondary ms-2">Clear Filter</a>
                                @endif
=======
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<<<<<<< HEAD


=======
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
	<div class="card border-top border-0 border-4 border-primary">
					<div class="card-body">
                        
						<div class="card-title d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="bx bxs-file me-1 font-22 text-primary"></i>
                                <h5 class="mb-0 text-primary">Order</h5>
                            </div>
							<div>
                                {{-- <a href="{{ route('ordere-add') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add Order</a> --}}
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
										<th>Status</th>
										<th>Total</th>
										<th>Payment Status</th>
										<th>Payment Method</th>
										<th>Date</th>
										<th>File</th>
                                        <th>View Details</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($order as $key=> $value)
									<tr>
                                        <td>{{ $key + 1 }}</td>
										<td>{{ $value->code ?? '' }}</td>
										<td><div class="d-flex align-items-center">
<<<<<<< HEAD
                                    <img src="{{ asset('images/profile/' .($value->user ? $value->user->image : '') ) }}" onerror="this.onerror=null;this.src='{{ asset($profile) }}';" class="product-img-2" alt="product img" style="margin-right: 8px;"> 
                                    <span>{{ $value->user ? $value->user->name : 'Unknown User' }}</span></div>
                                        </td>
										<td>
                                         <div class="badge rounded-pill  bg-light-info p-2 text-uppercase px-3"  style="color: {{ $value->status->color ?? '' }};"><i class="bx bxs-circle align-middle me-1"></i>{{$value->status->name ?? 'No Status'}}</div></td>
=======
                                    <img src="{{ asset('images/profile/' .($value->user->image ?? '') ) }}" onerror="this.onerror=null;this.src='{{ asset($profile) }}';" class="product-img-2" alt="product img" style="margin-right: 8px;"> 
                                    <span>{{ $value->user->name ?? '' }}</span></div>
                                        </td>
										<td>
                                         <div class="badge rounded-pill  bg-light-info p-2 text-uppercase px-3"  style="color: {{ $value->status->color ?? '' }};"><i class="bx bxs-circle align-middle me-1"></i>{{$value->status->name ?? ''}}</div></td>
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
										<td>{{ $value->total_amount ?? '-'}}</td>
										<td  style="color: {{ $value->paymentStatus->color ?? '' }};font-weight:500;"><i class="bx bxs-circle align-middle me-1"></i>{{ $value->paymentStatus->name ?? '-'}}</td>
										<td>{{ $value->payment_method ?? 'Wallet'}}</td>
										<td>{{ $value->updated_at }}</td>
										<td>
                                         @if($value->files)
                                        <a href="{{ asset('images/order/' . $value->files) }}" target="_blank"  class="btn btn-primary btn-sm radius-30 px-4">
                                          View File
                                          </a>
                                          @else
                                             —
                                         @endif
                                       </td>

										<td><a href="{{route('show-invoice',['id'=>$value->id])}}" type="button" class="btn btn-primary btn-sm radius-30 px-4">View Details</a></td>
                                        <td>
											<div class="d-flex">
                                                	@if(Auth::user()->role_id === 1)
											<span class="order-actions-primary">
    <button type="button" class="ms-2 Orderassigned btn btn-primary btn-sm radius-30 px-4" 
            data-bs-toggle="tooltip" data-bs-placement="top"
            data-id="{{ $value->id }}"
            data-assigned_id="{{ $value->assigned_to ?? 0 }}"
            data-bs-original-title="Assign order">
        Assign
    </button>
</span>
											  	@endif
											 @if($value->assigned_to == 0 && Auth::user()->role_id === 2)
											 <span class="order-actions-primary">
                                            <form action="{{ route('order-accept', $value->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                         <button type="submit" class="btn btn-primary btn-sm radius-30 px-4" >
                                           Accept Order
                                        </button>
                                           </form>
                                          </span>
											  	@endif

											  <span class="order-actions-primary">
													<a href="javascript:;" class="ms-2 openStatusModel" data-bs-toggle="tooltip" data-bs-placement="top" 
													data-id="{{ $value->id }}"
<<<<<<< HEAD
													data-status_id="{{ $value->status->id ?? ''}}"
=======
													data-status_id="{{ $value->status->id ?? 0}}"
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
													data-bs-original-title="OrderStatus"><i class="bx bx-message-square-edit"></i></a>
												</span>
											  <span class="order-actions-primary">
													<a href="javascript:;" class="ms-2 openPaymentModel" data-bs-toggle="tooltip" data-bs-placement="top" 
													data-id="{{ $value->id }}"
													data-payment_id="{{ $value->payment_status_id}}"
													data-bs-original-title="PaymentStatus"><i class="bx bx-edit"></i></a>
												</span>

												@if(empty($value->deleted_at))
												<span class="order-actions-primary">
													<a href="{{ route('order-delete', ['id' => $value->id]) }}" class="ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete"><i class="bx bx-trash"></i></a>
												</span>
												@else
												<span class="order-actions-danger">
													<a href="{{ route('order-delete', ['id' => $value->id]) }}" class="ms-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Restore"><i class="bx bx-revision"></i></a>
												</span>
												@endif
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

<div class="modal fade" id="Orderassign" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Order Assigned </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
							
					<form action="{{route('order-assign-employee')}}" method="POST" class="row g-3" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="orderId" class="form-control" id="orderId" required>
    
    <div>
        <label for="status1" class="form-label">Employee</label>
        <select name="employee_id" class="form-select @error('employee_id') is-invalid @enderror" id="assigned_id">
            @foreach ($employee as $data )
			
                <option value="{{ $data->id}}" {{ old('employee_id') == $data->id ? 'selected' : '' }}>
                    {{ $data->name }}
                </option>
            @endforeach
        </select>
        @error('employee_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Change</button>
						</div>
					</form>

				</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ChangeStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Change Status</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
							
					<form action="{{route('order-status-update')}}" method="POST" class="row g-3" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="order_id" class="form-control" id="order_id" required>
    
    <div>
        <label for="status1" class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror" id="status_id">
            @foreach ($orderstatus as $data )
<<<<<<< HEAD
                <option value="{{ $data->id}}" {{ old('status') == $data->id ? 'selected' : '' }}>
=======
                <option value="{{ $data->id}}" {{ old('status_id') == $data->id ? 'selected' : '' }}>
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
                    {{ $data->name }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
						{{-- <div id="divCommision">
							<label for="advance" class="form-label">Commision</label>
                            <input type="number" step=".01" name="advance" class="form-control @error('advance') is-invalid @enderror" id="advance" >
							@error('advance')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>
						
						<div id="divDocuments">
							<label for="documents" class="form-label">Add Document</label>
							<input type="file" name="documents[]" class="form-control @error('documents') is-invalid @enderror" id="documents" multiple>
							@error('documents')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div> --}}

						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Change</button>
						</div>
					</form>

				</div>
		</div>
	</div>
</div>


<div class="modal fade" id="paymentStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"> Recieve Payment </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
							
					<form action="{{route('payment-update')}}" method="POST" class="row g-3" enctype="multipart/form-data">
					@csrf
                    	<input type="hidden" name="payment_id" class="form-control" id="payment_id" required>
					
						   
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Amount<code>*</code></label>
                                        <input type="number" name="amount" step=".01" class="form-control @error('utr_no') is-invalid @enderror" required>
                                        @error('utr_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Payment Mode</label>
										<select name="payment_mode" class="form-select @error('payment_mode') is-invalid @enderror">
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="NEFT / RTGS">NEFT / RTGS</option>
                                            <option value="IMPS">IMPS</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                        @error('payment_mode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">UTR / Transaction No<code>*</code></label>
                                        <input type="text" name="utr_no" class="form-control @error('utr_no') is-invalid @enderror" required>
                                        @error('utr_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Upload Screenshot</label>
                                        <input type="file" name="utr_img" class="form-control @error('utr_img') is-invalid @enderror" accept="image/*" required>
                                        @error('utr_img')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                             <div class="mb-3">
                                    <label class="form-label">Description / Remarks</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
						<div class="text-center">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Change</button>
						</div>
					</form>

				</div>
		</div>
	</div>
</div>


@endsection
@push('scripts')
<script>
    $(document).on("click", ".Orderassigned", function () {

        let id = $(this).data("id");
        let assigned_id = $(this).data("assigned_id");
        
        $('#orderId').val(id);
        $('#assigned_id').val(assigned_id);
        $("#Orderassign").modal("show");
    });

    $(document).on("click", ".openStatusModel", function () {

        let id = $(this).data("id");
<<<<<<< HEAD
        let status = $(this).data("status_id");
=======
        let status_id = $(this).data("status_id");
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514

        $('#divCommision').hide();
        $('#divDocuments').hide();

        if(status == 2){
            $('#divCommision').show();
            $('#status').val(status);
        }
        else if(status == 3){
            $('#divDocuments').show();
            $('#status').val(status);
        }
         
        $('#order_id').val(id);
<<<<<<< HEAD

=======
       $('#status_id').val(status_id);
>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
        $("#ChangeStatus").modal("show");
    });


	$(document).on("click",".openPaymentModel",function(){
           let id = $(this).data("id");
           let payment = $(this).data("payment_id");

          $('#payment_id').val(id);
		  
		     $("#paymentStatus").modal("show");

	});

<<<<<<< HEAD

</script>
=======
    $(document).ready(function() {
		
        var table = $('#example').DataTable( {
            lengthChange: true,
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'print'],
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

>>>>>>> fac25bf97f0964bff9ae18d343c7e2fc9fd85514
@endpush