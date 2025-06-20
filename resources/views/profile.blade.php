@extends('layouts.app')
@section('title', 'User Profile')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title mb-0">User Profile</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Overview -->
        <div class="col-xl-4 col-lg-5">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ $user->profile_image ?? asset('assets/images/no_profile_image.png') }}"
                        class="rounded-circle avatar-lg img-thumbnail object-fit-cover" alt="Profile Image"
                        style="width: 120px; height: 120px; object-fit: cover;">
                    <h4 class="my-2">{{ $user->name }}</h4>
                    <p class="text-muted mb-2">Administrator</p>

                    <hr>
                    <div class="text-start">
                        <h5 class="text-uppercase fw-bold mb-3">About Me</h5>
                        <p><strong>Full Name:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>

                        <p><strong>Signature:</strong></p>
                        <img src="{{ $user->sign_image }}" alt="Sign Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>

                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <a href="#" class="social-list-item border-primary text-primary"><i
                                    class="mdi mdi-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-list-item border-danger text-danger"><i
                                    class="mdi mdi-google"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-list-item border-info text-info"><i
                                    class="mdi mdi-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="social-list-item border-secondary text-secondary"><i
                                    class="mdi mdi-github"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Profile Edit Forms -->
        <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="header-title mb-3">Edit Profile Information</h4>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" name="name" id="fullname" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input type="email" name="email" id="emailaddress" class="form-control"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="sign_image" class="form-label">Upload Signature Image</label>
                                <input type="file" name="sign_image" id="sign_image" class="form-control">
                                @if ($user->sign_image)
                                    <div class="mt-2">
                                        <img src="{{ $user->sign_image }}" alt="Current Sign" style="max-height: 80px;"
                                            class="img-thumbnail">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Change Password</h4>

                    <form action="{{ route('profile.change-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="newpassword" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="newpassword"
                                class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirmpassword" class="form-label">Confirm Password</label>
                            <input type="password" name="new_password_confirmation" id="confirmpassword"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror" required>
                            @error('new_password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
