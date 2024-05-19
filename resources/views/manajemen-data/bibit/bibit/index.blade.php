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
            @if (auth()->check() && (auth()->user()->level == 'Admin'))
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <button type="button" data-toggle="modal" data-target="#add-bibit" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi_col_order"
                                class="table table-striped table-bordered display no-wrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bibit</th>
                                        <th>Jumlah</th>
                                        <th>Diinputkan oleh</th>
                                        @if (auth()->check() && (auth()->user()->level == 'Admin'))
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalJumlah as $key => $bibit)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $bibit->bibit }}</td>
                                            @if ($bibit->total_jumlah > 0)
                                                <td>
                                                    <button type="button" class="btn btn-success btn-rounded"><i
                                                        class="fas fa-check-circle"></i> Tersedia : {{ $bibit->total_jumlah }}</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-rounded"><i
                                                        class="fas fa-times-circle"></i> Tidak Tersedia</button>
                                                </td>
                                            @endif
                                            <td>{{ $bibit->inputed_by }}</td>
                                            @if (auth()->check() && (auth()->user()->level == 'Admin'))
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit-bibit-{{ $bibit->bibitid }}"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delete-bibit-{{ $bibit->bibitid }}"><i class="fa fa-trash"></i></button>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create -->
    <div id="add-bibit" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('bibit.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Bibit</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="bibit">
                        </div>
                        <input type="hidden" class="form-control" name="inputed_by" value="{{ $user->level }}">
                    </div>
                    <div class="modal-body">
                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Foto Bibit</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="foto">
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Keterangan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Update -->
    @foreach ($data as $bibit)
    <div id="edit-bibit-{{ $bibit->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="edit-bibit-{{ $bibit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Edit
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('bibit.update', $bibit->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Bibit</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="bibit" value="{{ $bibit->bibit }}">
                        </div>
                        <input type="hidden" class="form-control" name="inputed_by" value="{{ $bibit->inputed_by }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Delete -->
    <div id="delete-bibit-{{ $bibit->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="delete-bibit-{{ $bibit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('bibit.destroy', $bibit->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" class="form-control" name="id" value="{{ $bibit->id }}"><br>
                    <p class="mx-3">Apakah anda yakin ingin menghapus data?</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
