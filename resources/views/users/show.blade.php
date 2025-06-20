@extends('layouts.app')
@section('title', 'Maklumat Pembeli')
@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row align-items-center mb-4">
            <div class="col-md-8">
                <div class="d-flex align-items-center gap-3">
                    <i class="uil-edit text-primary fs-2"></i>
                    <h2 class="mb-0 fw-bold">Maklumat Pembeli</h2>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item"><a href="{{ route('pembelis.index') }}">Pembeli</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Maklumat Pembeli</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Pembeli Info -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        <i class="uil-user me-2"></i> Maklumat Pembeli
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <p class="mb-0 text-muted">Nama</p>
                                <h6 class="fw-bold">{{ $pembeli->nama }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-muted">Alamat</p>
                                <h6 class="fw-bold">{{ $pembeli->alamat }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-muted">No Telefon</p>
                                <h6 class="fw-bold">{{ $pembeli->no_hp }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0 text-muted">Email</p>
                                <h6 class="fw-bold">{{ $pembeli->email }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resit List -->
        <div class="row">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        <i class="uil-receipt me-2"></i> Senarai Resit Pembeli
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap text-center" id="resitTable">
                                <thead style="background-color: #6169D0;" class="text-white">
                                    <tr>
                                        <th>ID Resit</th>
                                        <th>Tarikh</th>
                                        <th>Jumlah Balak</th>
                                        <th class="text-end">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembeli->resits as $resit)
                                        <tr id="resit-row-{{ $resit->id }}">
                                            <td>{{ $resit->id }}</td>
                                            <td>{{ $resit->created_at->format('d M Y') }}</td>
                                            <td>{{ count($resit->transaksi) }}</td>
                                            <td class="text-end">
                                                <button
                                                    onclick="showResitTransaksi({{ $resit->id }}); highlightResitRow({{ $resit->id }});"
                                                    class="btn btn-success btn-sm">
                                                    <i class="uil-eye"></i> Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light fw-semibold">
                        <i class="uil-receipt me-2"></i> Senarai Transaksi
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap text-center" id="transaksiTable">
                                <thead style="background-color: #6169D0;" class="text-white">
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>ID Resit</th>
                                        <th>Nama Pembeli</th>
                                        <th>Jenis Balak</th>
                                        <th>Tarikh</th>
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
    <script>
        $(function() {
            $('#resitTable').DataTable({
                responsive: true,
                processing: true,
                "language": {
                    "url": "{{ asset('/assets/js/datatable-my.json') }}"
                }
            });

            $('#transaksiTable').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                "language": {
                    "url": "{{ asset('/assets/js/datatable-my.json') }}"
                },
                "columnDefs": [{
                    orderable: false,
                    targets: 4
                }]
            });

            var allResits = @json($pembeli->resits->load('transaksi', 'transaksi.pembeli', 'transaksi.balak'));

            function showResitTransaksi(resitId = 0) {
                var selectedResit = allResits.find(function(resit) {
                    return resit.id === resitId;
                });

                if (!selectedResit) {
                    $('#transaksiTable').DataTable().clear().draw();
                    $('#transaksiTable').closest('.card').find('.card-header').html(
                        `<i class="uil-receipt me-2"></i> Senarai Transaksi untuk Resit ID: ${resitId} (Tiada transaksi dijumpai)`
                    );
                    return;
                }

                var transaksis = selectedResit ? selectedResit.transaksi : [];
                var transaksiTable = $('#transaksiTable').DataTable();
                transaksiTable.clear().draw();

                transaksis.forEach(function(transaksi) {
                    transaksiTable.row.add([
                        transaksi.id,
                        transaksi.resit_id,
                        transaksi.pembeli ? transaksi.pembeli.nama : '',
                        transaksi.balak ? transaksi.balak.jenis_pokok : '',
                        transaksi.tarikh_dibeli
                    ]);
                });

                transaksiTable.draw();
                $('#transaksiTable').closest('.card').find('.card-header').html(
                    `<i class="uil-receipt me-2"></i> Senarai Transaksi untuk Resit ID: ${resitId}`
                );
            }
            window.showResitTransaksi = showResitTransaksi;

            function highlightResitRow(resitId) {
                $('#resitTable tbody tr').removeClass('table-active');
                $('#resit-row-' + resitId).addClass('table-active');
            }
            window.highlightResitRow = highlightResitRow;
        });
    </script>
@endsection
