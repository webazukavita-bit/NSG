@extends('admin.layouts.app')

@section('content')
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <i class="bx bx-category me-1 font-22 text-primary"></i>
                <h5 class="mb-0 text-primary">Department List</h5>
            </div>
            <a href="{{ route('department.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add Department
            </a>
        </div>

        <hr>

        <div class="table-responsive">
           	<table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th width="60">#</th>
                        <th> Department Name</th>
                        <th>Slug</th>
                        <th width="160" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->name }}</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $item->slug }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('department.edit', $item) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="bx bx-edit"></i>
                                </a>

                                <form action="{{ route('department.destroy', $item->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button onclick="return confirm('Delete this department?')"
                                            class="btn btn-sm btn-danger">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No departments found
                            </td>
                        </tr>
                    @endforelse
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
    } );
</script>
@endpush