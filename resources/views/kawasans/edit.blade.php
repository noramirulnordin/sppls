@extends('layouts.app')
@section('title', 'Edit Kawasan')
@section('content')
    <div class="container">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-plus text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Edit Kawasan</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('kawasans.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kawasans.update', $kawasan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Kawasan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $kawasan->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_permit" class="form-label">No Permit</label>
                                <input type="text" class="form-control @error('no_permit') is-invalid @enderror"
                                    id="no_permit" name="no_permit" value="{{ old('no_permit', $kawasan->no_permit) }}">
                                @error('no_permit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lori_id" class="form-label">Lori</label>
                                <select class="select2 form-control select2-multiple" data-toggle="select2"
                                    multiple="multiple" data-placeholder="Sila Pilih ..."
                                    @error('lori_id') is-invalid @enderror" id="lori_id" name="lori_id[]">
                                    @foreach ($loris as $lori)
                                        <option value="{{ $lori->id }}"
                                            {{ in_array($lori->id, old('lori_id', $kawasan->lori->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $lori->no_pendaftaran }}</option>
                                    @endforeach
                                </select>
                                @error('lori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('kawasans.index') }}" class="btn btn-secondary me-2"><i
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
