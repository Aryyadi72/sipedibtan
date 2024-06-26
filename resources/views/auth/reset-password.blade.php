
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ asset('main-assets/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box row text-center">
                <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url({{ asset('main-assets/assets/images/big/forest.jpg') }});">
                </div>
                <div class="col-lg-5 col-md-7 bg-white">
                    <div class="p-3">
                        <img src="{{ asset('main-assets/assets/images/big/icon.png') }}" alt="wrapkit">
                        <h2 class="mt-3 text-center">Reset Password</h2>
                        <form class="mt-4" action="{{ route('reset.send') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" placeholder="Masukkan password baru" name="new_password" required>
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
