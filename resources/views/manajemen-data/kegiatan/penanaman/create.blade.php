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
                        <form class="mt-3 form-horizontal">
                            <div class="form-group row">
                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Nama</label>
                                <div class="col-sm-11">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Bibit</label>
                                <div class="col-sm-11">
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <br><br><br>

                                <label for="inputHorizontalSuccess" class="col-sm-1 col-form-label">Jumlah</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="name@example.com">
                                </div>

                                <br><br>

                                <div class="col-12 align-self-center">
                                    <div class="customize-input float-right">
                                        <button type="button" class="btn btn-primary btn-rounded">Submit</button>
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
