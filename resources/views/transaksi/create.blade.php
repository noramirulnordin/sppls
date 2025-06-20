@extends('layouts.app')
@section('title', 'Pembelian Balak')
@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="mdi mdi-cart-plus text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Pembelian Balak</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('transaksis.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div id="progressbarwizard">

                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                <li class="nav-item">
                                    <a href="#pembeli-2" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 pt-2 pb-2">
                                        <span class="badge bg-primary me-2">1</span>
                                        <i class="uil-user me-1"></i>
                                        <span class="d-none d-sm-inline">Pembeli</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#balak-tab-2" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 pt-2 pb-2">
                                        <span class="badge bg-primary me-2">2</span>
                                        <i class="uil-trees me-1"></i>
                                        <span class="d-none d-sm-inline">Balak</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#resit-2" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 pt-2 pb-2">
                                        <span class="badge bg-primary me-2">3</span>
                                        <i class="uil-truck me-1"></i>
                                        <span class="d-none d-sm-inline">Lori</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content b-0 mb-0">

                                <div id="bar" class="progress mb-3" style="height: 7px;">
                                    <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
                                    </div>
                                </div>

                                <div class="tab-pane" id="pembeli-2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="userName1">Nama
                                                    Pembeli
                                                </label>
                                                <div class="col-md-8">
                                                    <select class="form-control select2" data-toggle="select2" required
                                                        id="pembeli_id" name="pembeli_id">
                                                        <option>Pilih Pembeli</option>
                                                        @foreach ($pembelis as $pembeli)
                                                            <option value="{{ $pembeli->id }}"
                                                                {{ old('pembeli_id') == $pembeli->id ? 'selected' : '' }}
                                                                no-hp="{{ $pembeli->no_hp }}"
                                                                alamat="{{ $pembeli->alamat }}">
                                                                ID: {{ $pembeli->id }} - {{ $pembeli->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="toggleCreateUser()"> <span class="btn-inner--icon"><i
                                                                class="uil-plus"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>



                                            <div id="createUserForm" style="display: none;">
                                                <div class="row mb-3">
                                                    <div class="col-12 text-center mb-3">
                                                        <i class="uil-user-plus text-primary display-6"></i>
                                                    </div>
                                                    <label class="col-md-3 col-form-label" for="namaPembeli">Nama
                                                        Pembeli
                                                    </label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="namaPembeli" class="form-control"
                                                            placeholder="Masukkan nama pembeli baru">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="no_hp_pembeli">No
                                                        Telefon
                                                        Pembeli</label>
                                                    <div class="col-md-9">
                                                        <input type="number" id="no_hp_pembeli" name="no_hp_pembeli"
                                                            class="form-control"
                                                            placeholder="Masukkan no telefon pembeli baru">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="alamat_pembeli">Alamat
                                                        Pembeli</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="alamat_pembeli" name="alamat_pembeli"
                                                            class="form-control" placeholder="Masukkan alamat pembeli baru">
                                                    </div>
                                                </div>
                                                <div class="col-12 text-center mb-3">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="storePembeli()"> <span class="btn-inner--icon"><i
                                                                class="uil-plus"></i></span>
                                                        <span class="btn-inner--text">Tambah Pembeli</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-inline mb-0 wizard mt-3">

                                        <li class="next list-inline-item float-end">
                                            <a href="#" class="btn btn-info">Teruskan</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="balak-tab-2">
                                    <div class="row">
                                        <!-- Table Column -->
                                        <div class="col-md-8 col-12">
                                            <h5 class="text-center">Senarai Balak</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="balakTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Gambar</th>
                                                            <th>Jenis Pokok</th>
                                                            <th>Panjang</th>
                                                            <th>Diameter</th>
                                                            <th>Status</th>
                                                            <th>Tindakan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <h5 class="text-center">
                                                <i class="uil-shopping-cart-alt text-primary me-2"></i>
                                                Troli Balak
                                            </h5>
                                            <div id="cart" class="border rounded p-3"
                                                style="max-height: 500px; overflow-y: auto;">
                                                <p class="text-muted text-center" id="cart-empty">Tiada item dalam
                                                    troli.</p>
                                                <ul class="list-group" id="cart-items"></ul>
                                                <div class="mt-3 text-end">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="clearCart()">
                                                        <i class="uil-trash-alt"></i> Kosongkan Troli
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        onclick="submitCart()">
                                                        <i class="mdi mdi-content-save"></i> Simpan Balak
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-inline mb-0 wizard  mt-3">
                                        <li class="previous list-inline-item">
                                            <a href="#" class="btn btn-info">Kembali</a>
                                        </li>
                                        <li class="next list-inline-item float-end">
                                            <a href="#" class="btn btn-info">Teruskan</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane" id="resit-2">
                                    <div class="container">
                                        <div class="d-flex justify-content-center">
                                            <div class="resit-paper p-0 m-0 col-md-8"
                                                style="
                                                background: #fff;
                                                border: 1px dashed #333;
                                                border-radius: 16px 16px 40px 40px/16px 16px 60px 60px;
                                                box-shadow: 0 4px 24px rgba(0,0,0,0.08);
                                                max-width: 50%;
                                                width: 100%;
                                                margin: 0 auto;
                                                position: relative;
                                                overflow: hidden;">
                                                <div
                                                    style="height: 16px; background: repeating-linear-gradient(90deg, #fff, #fff 8px, #eee 8px, #eee 16px); border-bottom: 1px dashed #bbb;">
                                                </div>
                                                <div class="p-4 pb-2" id="print-div">
                                                    <h4 class="text-center mb-3 text-uppercase"
                                                        style="letter-spacing: 2px;">Rumusan</h4>
                                                    <!-- Resit Table -->
                                                    <div id="resit-content" class="mb-3">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered align-middle text-center mb-0"
                                                                style="font-size: 13px;">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>Bil</th>
                                                                        <th>ID Pokok</th>
                                                                        <th>Jenis Pokok</th>
                                                                        <th>Panjang (m)</th>
                                                                        <th>Diameter (cm)</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="resit-table-body"></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- Buyer and Resit Information -->
                                                    <div class="border rounded p-3 mb-2 bg-white"
                                                        style="font-size: 13px;">
                                                        <h6 class="text-uppercase mb-2" style="font-size: 14px;">Maklumat
                                                            Pembeli</h6>
                                                        <div class="mb-1">
                                                            <strong>Nama:</strong> <span id="pembeli-nama"
                                                                class="ms-2"></span>
                                                        </div>
                                                        <div class="mb-1">
                                                            <strong>No Telefon:</strong> <span id="pembeli-no-hp"
                                                                class="ms-2"></span>
                                                        </div>
                                                        <div class="mb-1">
                                                            <strong>Alamat:</strong> <span id="pembeli-alamat"
                                                                class="ms-2"></span>
                                                        </div>

                                                        <hr class="my-2">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <strong>Tarikh:</strong> <span id="resit-date"
                                                                    class="ms-2">{{ now()->format('d M Y') }}</span>
                                                            </div>
                                                            <div class="col-6 text-end">
                                                                <strong>Jumlah Balak:</strong> <span id="total-balak"
                                                                    class="ms-2">0</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Perforation effect bottom -->
                                                <div
                                                    style="height: 16px; background: repeating-linear-gradient(90deg, #fff, #fff 8px, #eee 8px, #eee 16px); border-top: 1px dashed #bbb;">
                                                </div>
                                            </div>

                                            <div class="col-md-4 ms-md-4">
                                                <div class="card shadow-sm border-0 h-100">
                                                    <div class="card-header bg-primary text-white text-center rounded-top">
                                                        <i class="uil-truck display-6"></i>
                                                        <h5 class="card-title mb-0 mt-2" style="font-weight: 600;">Pilih
                                                            Lori</h5>
                                                    </div>
                                                    <div class="card-body p-4">
                                                        <label for="kawasan_id"
                                                            class="form-label fw-semibold mb-2">Senarai
                                                            Kawasan</label>
                                                        <select id="kawasan_id" class="form-select form-select-lg mb-3"
                                                            style="font-size: 1rem;">
                                                            <option value="">-- Sila Pilih Kawasan --</option>
                                                            @foreach ($kawasans as $kawasan)
                                                                <option value="{{ $kawasan->id }}">
                                                                    {{ $kawasan->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <label for="lori_id" class="form-label fw-semibold mb-2">Senarai
                                                            Lori</label>
                                                        <select id="lori_id" class="form-select form-select-lg mb-3"
                                                            style="font-size: 1rem;">
                                                            <option value="">-- Sila Pilih Kawasan --</option>
                                                        </select>
                                                        <div class="alert alert-info mt-3 mb-0 py-2 px-3 small"
                                                            style="font-size: 0.95em;">
                                                            <i class="uil-info-circle"></i>
                                                            Sila pilih kawasan dan lori yang akan digunakan untuk
                                                            penghantaran balak.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="text-end mt-4">
                                            <button id="print-button" type="button"
                                                class="btn btn-outline-secondary me-2" onclick="printResit()"><i
                                                    class="uil-print"></i> Cetak
                                                Rumusan</button>
                                            <button id="simpan-button" type="button" class="btn btn-success"
                                                onclick="saveResit()"><i class="mdi mdi-content-save"></i> Simpan
                                                Data</button>
                                        </div>
                                    </div>
                                    <style>
                                        /* Optional: Add a shadow and resit-like font */
                                        .resit-paper {
                                            font-family: 'Courier New', Courier, monospace;
                                        }
                                    </style>

                                    <ul class="list-inline mb-0 wizard mt-3">
                                        <li class="previous list-inline-item">
                                            <a href="#" class="btn btn-info">Kembali</a>
                                        </li>

                                    </ul>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        let enableAlertQuitPage = false;

        window.onbeforeunload = function(e) {
            if (enableAlertQuitPage) return;
            e.preventDefault();
        };

        $(document).ready(function() {
            $('#progressbarwizard').bootstrapWizard({
                'tabClass': 'nav nav-pills nav-justified',
                'nextSelector': '.next',
                'previousSelector': '.previous',
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index + 1;
                    var $percent = ($current / $total) * 100;

                    $('#bar .bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#balakTable').DataTable({
                "language": {
                    "url": "{{ asset('/assets/js/datatable-my.json') }}"
                },
                processing: true,
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5],
                    "className": "text-center"
                }],
                ajax: {
                    url: '{{ route('balaks.index') }}',
                    data: {
                        from_transaksi: 1
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'gambar',
                        name: 'gambar',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jenis_pokok',
                        name: 'jenis_pokok'
                    },
                    {
                        data: 'panjang',
                        name: 'panjang'
                    },
                    {
                        data: 'diameter',
                        name: 'diameter'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: function(data) {
                            return `
                                <button type="button" class="btn btn-sm btn-info add-to-cart"
                                 data-id="${data.id}" data-name="${data.jenis_pokok}" data-panjang="${data.panjang}" data-diameter="${data.diameter}">Tambah</button>
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

        function toggleCreateUser() {
            var createUserForm = $('#createUserForm');
            if (createUserForm.is(':hidden')) {
                createUserForm.show();
            } else {
                createUserForm.hide();
            }
        }

        function storePembeli() {

            var namaPembeli = $('#namaPembeli').val();
            var noHpPembeli = $('#no_hp_pembeli').val();
            var alamatPembeli = $('#alamat_pembeli').val();

            if (namaPembeli.trim() === '') {
                swal.fire({
                    title: 'Error',
                    text: 'Nama pembeli tidak boleh kosong',
                    icon: 'error'
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/pembelis",
                data: {
                    nama: namaPembeli,
                    no_hp: noHpPembeli,
                    alamat: alamatPembeli,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#namaPembeli').val('');
                        $('#no_hp_pembeli').val('');
                        $('#alamat_pembeli').val('');
                        $('#createUserForm').hide();
                        var pembeliSelect = $('#pembeli_id');
                        pembeliSelect.empty();

                        pembeliSelect.append('<option value="">Pilih Pembeli</option>');
                        response.data.forEach(function(pembeli) {
                            var option = $('<option></option>')
                                .val(pembeli.id)
                                .text('ID: ' + pembeli.id + ' - ' + pembeli.nama)
                                .attr('no-hp', pembeli.no_hp)
                                .attr('alamat', pembeli.alamat);
                            pembeliSelect.append(option);
                        });


                        swal.fire({
                            title: 'Success',
                            text: 'Pembeli baru berhasil ditambahkan',
                            icon: 'success'
                        });
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                }
            });
        }

        function printResit() {
            saveResit(fromPrint = true);
        }



        function saveResit(fromPrint = false) {
            enableAlertQuitPage = true;
            let pembeliId = $('#pembeli_id').val();
            if (!pembeliId || pembeliId === '' || pembeliId === 'Pilih Pembeli') {
                swal.fire({
                    title: 'Error',
                    text: 'Sila pilih pembeli terlebih dahulu',
                    icon: 'error'
                });
                return;
            }
            if (cart.length === 0) {
                swal.fire({
                    title: 'Error',
                    text: 'Troli balak kosong',
                    icon: 'error'
                });
                return;
            }

            if ($('#lori_id').val() === '') {
                swal.fire({
                    title: 'Error',
                    text: 'Sila pilih lori untuk transaksi ini',
                    icon: 'error'
                });
                return;
            }

            swal.fire({
                title: 'Sahkan',
                text: 'Adakah anda pasti ingin menyimpan transaksi ini?. Semua data akan disimpan dan tidak boleh diubah.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, simpan',
                cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    saveTransaction(pembeliId, fromPrint);
                }
            });
        }

        function saveTransaction(pembeliId, fromPrint = false) {

            $.ajax({
                type: "POST",
                url: "/transaksis",
                data: {
                    pembeli_id: pembeliId,
                    balaks: cart,
                    kawasan_id: $('#kawasan_id').val(),
                    lori_id: $('#lori_id').val(),
                    from_print: fromPrint,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        swal.fire({
                            title: 'Success',
                            text: 'Transaksi berjaya disimpan.',
                            icon: 'success'
                        });
                        if (fromPrint) {
                            const resit = response.resit_id;
                            window.open(
                                "{{ route('resits.show', ['resit' => ':resit', 'from_print' => true]) }}"
                                .replace(':resit', resit),
                                '_blank'
                            );
                        }
                        window.location.href = "{{ route('resits.index') }}";
                    } else {
                        swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    swal.fire({
                        title: 'Error',
                        text: 'Terjadi ralat semasa menyimpan transaksi.',
                        icon: 'error'
                    });
                }
            });
        }


        $(document).on('change', '#kawasan_id', function() {
            const kawasanId = $(this).val();
            if (kawasanId) {
                $.ajax({
                    url: `/kawasans/${kawasanId}/loris`,
                    type: 'GET',
                    success: function(data) {
                        const loriSelect = $('#lori_id');
                        $('#lori_id').empty();
                        if (data.length === 0) {
                            loriSelect.append('<option value="">-- Tiada Lori Tersedia --</option>');
                        } else {
                            loriSelect.empty();
                            loriSelect.append('<option value="">-- Sila Pilih Lori --</option>');
                            data.forEach(lori => {
                                loriSelect.append(
                                    `<option value="${lori.id}">${lori.no_pendaftaran}</option>`
                                );
                            });

                        }
                    },
                    error: function() {
                        swal.fire({
                            title: 'Error',
                            text: 'Gagal memuatkan lori untuk kawasan ini.',
                            icon: 'error'
                        });
                    }
                });
            } else {
                $('#lori_id').empty();
                $('#lori_id').append('<option value="">-- Gagal --</option>');
            }
        });
    </script>
    <script>
        let cart = [];

        function updateCartUI() {
            const cartItemsEl = $('#cart-items');
            const cartEmptyEl = $('#cart-empty');
            cartItemsEl.empty();

            if (cart.length === 0) {
                cartEmptyEl.show();
                return;
            }

            cartEmptyEl.hide();
            cart.forEach(item => {
                const li = $('<li></li>').addClass(
                    'list-group-item d-flex justify-content-between align-items-center');
                li.html(`
                    ${item.name}
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeFromCart(${item.id})">×</button>
                `);
                cartItemsEl.append(li);
            });
        }

        function addToCart(id, name, panjang, diameter) {
            if (cart.some(item => item.id === id)) return; // prevent duplicates
            cart.push({
                id,
                name,
                panjang,
                diameter
            });
            updateCartUI();
        }

        function removeFromCart(id) {
            cart = cart.filter(item => item.id !== id);
            const row = $(`.add-to-cart[data-id="${id}"]`).closest('tr');
            row.show(); // Show the row again
            updateCartUI();
        }

        function clearCart() {
            cart = [];
            // Show all rows again
            $('#balakTable tbody tr').show();
            updateCartUI();
        }

        function submitCart() {
            var pembeliId = $('#pembeli_id').val();
            if (!pembeliId || pembeliId === '' || pembeliId === 'Pilih Pembeli') {
                swal.fire({
                    title: 'Error',
                    text: 'Sila pilih pembeli terlebih dahulu',
                    icon: 'error'
                });
                return;
            }
            if (cart.length === 0) {
                swal.fire({
                    title: 'Error',
                    text: 'Troli balak kosong',
                    icon: 'error'
                });
                return;
            }
            const resitTableBody = $('#resit-table-body');
            resitTableBody.empty();
            let totalBalak = 0;
            cart.forEach((item, index) => {
                resitTableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>${item.panjang || 'Tiada'}</td>
                        <td>${item.diameter || 'Tiada'}</td>

                    </tr>
                `);
                totalBalak++;
            });
            $('#pembeli-nama').text($('#pembeli_id option:selected').text());
            $('#pembeli-no-hp').text($('#pembeli_id option:selected').attr('no-hp') || 'Tiada');
            $('#pembeli-alamat').text($('#pembeli_id option:selected').attr('alamat') || 'Tiada');
            $('#total-balak').text(totalBalak);
            $('#resit-content').show();
            $('#progressbarwizard a[href="#resit-2"]').tab('show');
        }

        $(document).on('click', '.add-to-cart', function() {
            const id = parseInt($(this).data('id'));
            const name = $(this).data('name');
            const panjang = $(this).data('panjang');
            const diameter = $(this).data('diameter');

            $(this).closest('tr').hide();

            addToCart(id, name, panjang, diameter);
        });

        // window.onbeforeunload = function(e) {
        //     e.preventDefault();
        // };

        $(document).on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                var currentTab = $('#progressbarwizard .nav-link.active');
                var nextTab = currentTab.parent().next().find('.nav-link');
                if (nextTab.length) {
                    nextTab.tab('show');
                }
            }
        });
    </script>

@endsection
