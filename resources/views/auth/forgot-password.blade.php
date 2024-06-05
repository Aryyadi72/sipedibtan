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
                        <h2 class="mt-3 text-center">Reset Password</h2>
                        <form class="mt-4" action="{{ route('reset.pass') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="email" placeholder="Masukkan email" name="email" id="email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Masukkan password baru" name="new_password" id="new_password" required disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Konfirmasi password baru" name="password_confirmation" id="password_confirmation" required disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Reset Password</button>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        // Menggunakan jQuery untuk kenyamanan dalam mendengarkan event
        $(document).ready(function() {
            $('#email').on('blur', function() {
                var email = $(this).val();
                // Lakukan permintaan Ajax untuk memeriksa email
                $.ajax({
                    url: '{{ route('check.email') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: email
                    },
                    success: function(response) {
                        if (response.exists) {
                            // Jika email terdaftar, aktifkan kolom password baru
                            $('#new_password').prop('disabled', false);
                            $('#password_confirmation').prop('disabled', false);
                        } else {
                            // Jika email tidak terdaftar, kunci kolom password baru
                            $('#new_password').prop('disabled', true);
                            $('#password_confirmation').prop('disabled', true);
                        }
                    }
                });
            });
        });
    </script>
@endsection
