@extends('layouts.auth')

@section('auth')
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
            <div class="auth-box row">
                <div class="col-lg-4 col-md-5 modal-bg-img">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="{{ asset('main-assets/assets/images/big/icon.png') }}" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Login</h2>
                        <p class="text-center">Masukkan alamat email dan password yang telah terdaftar untuk mengakses dashboard.</p>
                        <form class="mt-4" action="{{ route('auth-authenticate') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="uname">Email</label>
                                        <input class="form-control" id="uname" type="email" name="email"
                                            placeholder="Masukkan email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd">Password</label>
                                        <input class="form-control" id="pwd" type="password" name="password"
                                            placeholder="Masukkan password" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Login</button>
                                    {{-- <a href="{{ route('dashboard') }}" class="btn btn-block btn-dark">Login</a> --}}
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Belum memiliki akun? <a href="{{ route('register-page') }}" class="text-danger">Register</a><br>
                                    {{-- Lupa password? <a href="{{ route('reset.index') }}" class="text-danger">Reset Password</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
