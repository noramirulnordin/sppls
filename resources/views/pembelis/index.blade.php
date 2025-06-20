@extends('layouts.app')

@section('title', 'Senarai Pembeli')

@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-users-alt text-primary display-5 me-3"></i>
                    <div>
                        <h2 class="page-title mb-0 fw-bold">Senarai Pembeli</h2>
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
                            <div class="col-sm-4">
                                <a href="{{ route('pembelis.create') }}" class="btn btn-danger mb-2"><i
                                        class="mdi mdi-plus-circle me-2"></i> Tambah Pembeli</a>
                            </div>
                            <div class="col-sm-8">
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
                                        <th>Id</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                ajax: '{{ route('pembelis.index') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'no_hp',
                        name: 'no_hp'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: function(data) {
                            return `
                                <a href="/pembelis/${data.id}/edit" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                                <a href="/pembelis/${data.id}" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>
                                <button class="btn btn-danger btn-sm" onclick="deletePembeli(${data.id})"><i class="mdi mdi-delete"></i></button>

                            `;
                        },
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ],
                responsive: true
            });
        });

        function deletePembeli(id) {
            Swal.fire({
                title: 'Adakah anda pasti?',
                text: "Anda tidak akan dapat memulihkan data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, padam!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/pembelis/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Dihapus!',
                                'Pembeli telah berjaya dipadam.',
                                'success'
                            );
                            $('#products-datatable').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Ralat!',
                                'Gagal memadam pembeli.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endsection
