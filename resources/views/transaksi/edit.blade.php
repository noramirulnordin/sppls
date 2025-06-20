@extends('layouts.app')
@section('title', 'Kemaskini Transaksi Pembeli')
@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-plus text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Kemaskini Transaksi Pembeli</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('transaksis.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kemaskini</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="pembeli_id" class="form-label">Pembeli</label>
                                <select class="form-select @error('pembeli_id') is-invalid @enderror" id="pembeli_id"
                                    name="pembeli_id" required>
                                    <option value="">Pilih Pembeli</option>
                                    @foreach ($pembelis as $pembeli)
                                        <option value="{{ $pembeli->id }}"
                                            {{ old('pembeli_id', $transaksi->pembeli_id) == $pembeli->id ? 'selected' : '' }}>
                                            ID: {{ $pembeli->id }} - {{ $pembeli->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pembeli_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="balak_id" class="form-label">Balak</label>
                                <select class="form-select @error('balak_id') is-invalid @enderror" id="balak_id"
                                    name="balak_id" required>
                                    <option value="">Pilih Balak</option>
                                    @foreach ($balaks as $balak)
                                        <option value="{{ $balak->id }}"
                                            {{ old('balak_id', $transaksi->balak_id) == $balak->id ? 'selected' : '' }}>
                                            ID: {{ $balak->id }} - {{ $balak->jenis_pokok }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('balak_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tarikh_dibeli" class="form-label">Tarikh Dibeli</label>
                                <input type="date" class="form-control @error('tarikh_dibeli') is-invalid @enderror"
                                    id="tarikh_dibeli" name="tarikh_dibeli"
                                    value="{{ old('tarikh_dibeli', $transaksi->tarikh_dibeli) }}" required>
                                @error('tarikh_dibeli')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
