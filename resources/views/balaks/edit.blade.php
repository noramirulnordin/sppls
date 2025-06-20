@extends('layouts.app')
@section('title', 'Edit Balak')
@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-edit text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Edit Balak</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('balaks.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('balaks.update', $balak->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="jenis_pokok" class="form-label">Jenis Pokok</label>
                                <input type="text" class="form-control @error('jenis_pokok') is-invalid @enderror"
                                    id="jenis_pokok" name="jenis_pokok"
                                    value="{{ old('jenis_pokok', $balak->jenis_pokok) }}" required>
                                @error('jenis_pokok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="panjang" class="form-label">Panjang</label>
                                <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                    id="panjang" name="panjang" value="{{ old('panjang', $balak->panjang) }}" required>
                                @error('panjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="diameter" class="form-label">Diameter</label>
                                <input type="number" class="form-control @error('diameter') is-invalid @enderror"
                                    id="diameter" name="diameter" value="{{ old('diameter', $balak->diameter) }}" required>
                                @error('diameter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="statuss" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="statuss"
                                    name="status" required>
                                    <option value="Tersedia"
                                        {{ old('status', $balak->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="Dijual"
                                        {{ old('status', $balak->status) == 'Dijual' ? 'selected' : '' }}>Dijual</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <img src="{{ $balak->gambar ? asset('storage/' . $balak->gambar) : asset('images/no-image.png') }}"
                                    alt="Gambar Balak" class="img-fluid" style="max-width: 200px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
