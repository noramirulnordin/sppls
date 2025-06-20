@extends('layouts.app')
@section('title', 'Edit Pekerja')
@section('content')
    <div class="container-fluid">

        <div class="row align-items-center mb-3 mt-2">
            <div class="col-md-8 col-12">
                <div class="d-flex align-items-center">
                    <i class="uil-plus text-primary display-6 me-3"></i>
                    <div>
                        <h3 class="page-title mb-0 fw-bold">Edit Pekerja</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 text-end mt-3 mt-md-0">
                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Utama</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $user->name }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="is_admin" class="form-label">Jenis Pekerja</label>
                                <select class="form-select @error('is_admin') is-invalid @enderror" id="is_admin"
                                    name="is_admin" required>
                                    <option value="" disabled selected>Pilih jenis pekerja</option>
                                    <option value="0" {{ $user->is_admin == 0 ? 'selected' : '' }}>Pekerja</option>
                                    <option value="1" {{ $user->is_admin == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('is_admin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 text-end">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a id="reset-password" href="{{ route('users.reset_password', $user->id) }}"
                                    class="btn btn-warning">Reset
                                    Password</a>
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#reset-password').click(function(e) {
            e.preventDefault();
            swal.fire({
                title: 'Amaran',
                text: 'Adakah anda pasti ingin menetapkan semula kata laluan pekerja ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tetapkan Semula',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = $(this).attr('href');
                }
            });

        });
    </script>
@endsection
