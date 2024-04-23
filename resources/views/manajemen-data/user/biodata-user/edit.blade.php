@extends('layouts.main')

@section('content')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{ $title }}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">{{ $title }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <a href="{{ route('masuk.index') }}" class="btn btn-warning btn-rounded"><i class="fas fa-angle-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="mt-3 form-horizontal" action="{{ route('biodata.update', $data->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama" value="{{ $data->nama }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" value="{{ $data->alamat }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="exampleFormControlSelect1" name="jenis_kelamin">
                                        <option selected disabled>Pilih Jenis Kelamin</option>
                                        <option value="Pria" {{ $data->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                                        <option value="Wanita" {{ $data->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                    </select>
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Umur</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="umur" value="{{ $data->umur }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">No KTP</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="no_ktp" value="{{ $data->no_ktp }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">No HP</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="no_telpon" value="{{ $data->no_telpon }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Pendidikan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pendidikan" value="{{ $data->pendidikan }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="agama" value="{{ $data->agama }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Domisili</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="domisili" value="{{ $data->domisili }}">
                                </div>

                                <br><br><br>

                                <div class="col-12 align-self-center">
                                    <div class="customize-input float-right">
                                        <button type="submit" class="btn btn-primary btn-rounded">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
