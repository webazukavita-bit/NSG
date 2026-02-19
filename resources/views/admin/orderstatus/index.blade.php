@extends('admin.layouts.app')

@section('content')

<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                {{-- <i class="bx bxs-flag-checkered me-1 font-22 text-primary"></i> --}}
                <h5 class="mb-0 text-primary">Order Status</h5>
            </div>
            <div>
                <a href="{{ route('order-status.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus"></i> Add Status
                </a>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Sn.</th>
                        <th>Status Name</th>
                        <th>Color</th>
                        <th>Order By</th>
                        {{-- <th>Process Order</th> --}}
                        <th>Image</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($orderStatus as $key => $status)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                <div class="badge rounded-pill bg-light-info p-2 text-uppercase px-3"
                                     style="color: {{ $status->color }}">
                                    <i class="bx bxs-circle align-middle me-1"></i>
                                    {{ $status->name }}
                                </div>
                            </td>

                            <td>
                                <span class="badge"
                                      style="background:{{ $status->color }}; color:#fff;">
                                    {{ $status->color }}
                                </span>
                            </td>

                            <td>{{ $status->order_by ?? '-' }}</td>
                             <td><img src="{{asset('images/order-status/'.$status->image_icon)}}" alt="" style="width: 60px;"></td>

                            <td>{{ $status->updated_at }}</td>

                            <td>
                                <div class="d-flex">
                                    <span class="order-actions-primary">
                                        <a href="{{ route('order-status.edit',$status->id) }}"
                                           class="ms-2"
                                           data-bs-toggle="tooltip"
                                           data-bs-original-title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                    </span>

                                    @if(empty($status->deleted_at))
                                        <span class="order-actions-primary">
                                            <form action="{{ route('order-status.delete',$status->id) }}"
                                                  method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('Delete this status?')"
                                                        class="btn p-0 ms-2"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        </span>
                                    @else
                                        <span class="order-actions-danger">
                                            <a href="{{ route('order-status.restore',$status->id) }}"
                                               class="ms-2"
                                               data-bs-toggle="tooltip"
                                               data-bs-original-title="Restore">
                                                <i class="bx bx-revision"></i>
                                            </a>
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

@endsection
@push('scripts')
<script>
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
@endpush