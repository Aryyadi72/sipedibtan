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
                    <a href="{{ route('lainnya.create') }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
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
                                        <th>Kegiatan</th>
                                        <th>Pelaksana</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <th>Foto</th>
                                        <th>Diinputkan oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $lainnya)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $lainnya->kegiatan }}</td>
                                            <td>{{ $lainnya->pelaksana }}</td>
                                            <td>{{ $lainnya->lokasi }}</td>
                                            <td>{{ $lainnya->keterangan }}</td>
                                            <td>{{ $lainnya->foto }}</td>
                                            <td>{{ $lainnya->inputed_by }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('lainnya.edit', $lainnya->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delete-lainnya"><i class="fa fa-trash"></i></button>
                                            </td>
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

    @foreach ($data as $lainnya)
    <!-- Delete -->
    <div id="delete-lainnya" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('lainnya.destroy', $lainnya->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" class="form-control" name="id" value="{{ $lainnya->id }}"><br>
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
