@extends('layouts.app')
@section('title', 'Tambah Balak')
@section('content')
    <div class="container-fluid px-2 px-md-4 py-4 bg-light">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-6 col-md-8">
                <div class="d-flex align-items-center mb-3 position-relative">
                    <h2 class="fw-bold mb-0 page-title flex-grow-1 text-center" style="font-size:1.6rem;">
                        Tambah Balak
                    </h2>
                    <a href="{{ route('balaks.index') }}" class="btn btn-secondary position-absolute end-0" style="top:0;">
                        <i class="mdi mdi-arrow-left"></i> <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4 py-4">
                        <form action="{{ route('balaks.store') }}" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('jenis_pokok') is-invalid @enderror"
                                    id="jenis_pokok" name="jenis_pokok" placeholder="Jenis Pokok"
                                    value="{{ old('jenis_pokok') }}" required>
                                <label for="jenis_pokok">Jenis Pokok</label>
                                @error('jenis_pokok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('panjang') is-invalid @enderror"
                                    id="panjang" name="panjang" placeholder="Panjang" value="{{ old('panjang') }}"
                                    required>
                                <label for="panjang">Panjang</label>
                                @error('panjang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control @error('diameter') is-invalid @enderror"
                                    id="diameter" name="diameter" placeholder="Diameter" value="{{ old('diameter') }}"
                                    required>
                                <label for="diameter">Diameter</label>
                                @error('diameter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select @error('status') is-invalid @enderror" id="statuss"
                                    name="status" required>
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>-- Pilih Status --
                                    </option>
                                    <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                    </option>
                                    <option value="Dijual" {{ old('status') == 'Dijual' ? 'selected' : '' }}>Dijual
                                    </option>
                                </select>
                                <label for="statuss">Status</label>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label fw-semibold">Gambar</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                                    <i class="mdi mdi-content-save me-1"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        .bg-light {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            background: #f7fafd !important;
        }

        .page-title {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            font-weight: 700;
            color: #22223b;
            letter-spacing: 0.01em;
        }

        .card {
            border-radius: 1.25rem !important;
        }

        .btn-light {
            border-radius: 0.7rem;
            background: #fff;
            color: #22223b;
            transition: background 0.14s, box-shadow 0.14s;
        }

        .btn-light:hover,
        .btn-light:focus {
            background: #f1f3f8;
            color: #0d6efd;
        }

        @media (max-width: 767px) {
            .card {
                border-radius: 0.7rem !important;
            }

            .btn-light span {
                display: none;
            }
        }
    </style>
@endsection
