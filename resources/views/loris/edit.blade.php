@extends('layouts.app')
@section('title', 'Kemaskini Lori')
@section('content')
    <div class="container">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-plus text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Kemaskini Lori</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('loris.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kemaskini Lori</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('loris.update', $lori->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="no_pendaftaran" class="form-label">No Pendaftaran</label>
                                <input type="text" class="form-control @error('no_pendaftaran') is-invalid @enderror"
                                    id="no_pendaftaran" name="no_pendaftaran" value="{{ $lori->no_pendaftaran }}" required>
                                @error('no_pendaftaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Lori</label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    id="jenis" name="jenis" value="{{ $lori->jenis }}">
                                @error('jenis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kapasiti" class="form-label">Kapasiti</label>
                                <input type="number" class="form-control @error('kapasiti') is-invalid @enderror"
                                    id="kapasiti" name="kapasiti" value="{{ $lori->kapasiti }}">
                                @error('kapasiti')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pembeli_id" class="form-label">Nama Pemilik</label>
                                <select class="form-select @error('pembeli_id') is-invalid @enderror" id="pembeli_id"
                                    name="pembeli_id" required>
                                    <option value="">Pilih Pemilik</option>
                                    @foreach ($pembelis as $pembeli)
                                        <option value="{{ $pembeli->id }}"
                                            {{ $lori->pembeli_id == $pembeli->id ? 'selected' : '' }}>
                                            {{ $pembeli->nama }}</option>
                                    @endforeach
                                </select>
                                @error('pembeli_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kawasan_id" class="form-label">Kawasan</label>
                                <select class="select2 form-control select2-multiple" data-toggle="select2"
                                    multiple="multiple" data-placeholder="Sila Pilih ..."
                                    @error('kawasan_id') is-invalid @enderror" id="kawasan_id" name="kawasan_id[]">
                                    @foreach ($kawasans as $kawasan)
                                        <option value="{{ $kawasan->id }}"
                                            {{ in_array($kawasan->id, $selectedKawasans) ? 'selected' : '' }}>
                                            {{ $kawasan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kawasan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('loris.index') }}" class="btn btn-secondary me-2"><i
                                        class="mdi mdi-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-content-save"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
