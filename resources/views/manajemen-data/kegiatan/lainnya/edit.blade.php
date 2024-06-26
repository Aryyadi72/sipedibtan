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
                        <form class="mt-3 form-horizontal" action="{{ route('lainnya.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Tanggal</label>
                                <div class="col-sm-11">
                                    <input type="date" class="form-control" name="tanggal" value="{{ $data->tanggal }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Kegiatan</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" name="kegiatan" value="{{ $data->kegiatan }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Pelaksana</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" name="pelaksana" value="{{ $data->pelaksana }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Lokasi</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" name="lokasi" value="{{ $data->lokasi }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Foto</label>
                                <div class="col-sm-11">
                                    <input type="file" class="form-control-file" id="exampleInputFile" name="foto" value="{{ $data->foto }}"><br>
                                    <img src="{{ asset('lainnya/' . $data->foto) }}" alt="Foto" width="100px" height="100px"><br><br>
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Inputed By</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" name="inputed_by" value="{{ $data->inputed_by }}">
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Keterangan</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" name="keterangan" value="{{ $data->keterangan }}">
                                </div>

                                <br><br><br><br>

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
