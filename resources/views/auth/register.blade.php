@extends('layouts.auth')

@section('auth')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ asset('main-assets/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box row text-center">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{ asset('main-assets/assets/images/big/forest.jpg') }});">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <img src="{{ asset('main-assets/assets/images/big/icon.png') }}" alt="wrapkit">
                        <h2 class="mt-3 text-center">Register untuk Login</h2>
                        <form class="mt-4" action="{{ route('register-store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Masukkan nama" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Masukkan email" name="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" placeholder="Masukkan password" name="password" required>
                                    </div>
                                </div>
                                <input class="form-control" type="hidden" name="level" value="Masyarakat">
                                <input class="form-control" type="hidden" name="inputed_by" value="Masyarakat">
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Register</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    Sudah memiliki akun? <a href="{{ route('login') }}" class="text-danger">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
