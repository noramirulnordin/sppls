@extends('layouts.app')

@section('title', 'Senarai Resit')

@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-receipt text-primary display-5 me-3"></i>
                    <div>
                        <h2 class="page-title mb-0 fw-bold">Senarai Resit</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-md-end mt-3 mt-md-0">
                {{ Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="text-sm-end">
                                    <button type="button"
                                        onclick="$('#products-datatable').DataTable().button('.buttons-print').trigger();"
                                        class="btn btn-info mb-2 me-1">
                                        <i class="mdi mdi-printer"></i>
                                    </button>
                                    <button type="button"
                                        onclick="$('#products-datatable').DataTable().button('.buttons-pdf').trigger();"
                                        class="btn btn-success mb-2 me-1">
                                        PDF
                                    </button>
                                    <button type="button"
                                        onclick="$('#products-datatable').DataTable().button('.buttons-excel').trigger();"
                                        class="btn btn-primary mb-2 me-1">
                                        EXCEL
                                    </button>
                                    <button type="button"
                                        onclick="$('#products-datatable').DataTable().button('.buttons-csv').trigger();"
                                        class="btn btn-secondary mb-2 me-1">
                                        CSV
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                <thead style="background-color: #6169D0;" class="text-white">
                                    <tr>
                                        <th>No Resit</th>
                                        <th>Nama Pembeli</th>
                                        <th>Tarikh</th>
                                        <th class="text-end">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resits as $resit)
                                        <tr>
                                            <td>{{ $resit->id }}</td>
                                            <td>{{ $resit->pembeli->nama }}</td>
                                            <td>{{ $resit->created_at->format('d M Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('resits.show', $resit->id) }}"
                                                    class="btn btn-primary btn-sm" target="_blank" rel="noopener">
                                                    <i class="uil-eye"></i>
                                                    Lihat
                                                </a>
                                                <a href="{{ route('resits.download', $resit->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="mdi mdi-download"></i>
                                                    Muat Turun
                                                </a>
                                                {{-- <a href="{{ route('resits.transactions', $resit->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="mdi mdi-format-list-bulleted"></i>
                                                    Senarai Transaksi
                                                </a> --}}
                                                <a href="{{ route('resits.destroy', $resit->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="event.preventDefault();
                                                        Swal.fire({
                                                            title: 'Anda pasti?',
                                                            text: 'Resit ini akan dipadam!',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#d33',
                                                            cancelButtonColor: '#3085d6',
                                                            confirmButtonText: 'Ya, padam!',
                                                            cancelButtonText: 'Batal'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('delete-form-{{ $resit->id }}').submit();
                                                            }
                                                        });">
                                                    <i class="uil-trash-alt"></i>
                                                    Padam
                                                </a>
                                                <form id="delete-form-{{ $resit->id }}"
                                                    action="{{ route('resits.destroy', $resit->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('scripts')
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#products-datatable').DataTable({
                "language": {
                    "url": "{{ asset('/assets/js/datatable-my.json') }}"
                },
                buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                processing: true,
                "columnDefs": [{
                    "targets": "_all",
                    "className": "text-center"
                }],
                responsive: true,
                autoWidth: false,
            });
        });
    </script>
@endsection
