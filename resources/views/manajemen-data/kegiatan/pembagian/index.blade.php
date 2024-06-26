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
                    <a href="{{ route('pembagian.create') }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('filter.pembagian') }}" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-2">Filter Data </label>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" class="form-control"
                                                        placeholder="First Input &amp; First Row" name="start_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" class="form-control"
                                                        placeholder="Second Input &amp; First Row" name="end_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-info">Filter</button>
                                    <button type="reset" class="btn btn-dark">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                                        <th>Tanggal</th>
                                        <th>Bibit</th>
                                        <th>Jumlah</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <th>Foto</th>
                                        <th>Diinputkan oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $pembagian)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pembagian->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ $pembagian->bibit->bibit }}</td>
                                            <td>{{ $pembagian->jumlah }}</td>
                                            <td>{{ $pembagian->lokasi }}</td>
                                            <td>{{ $pembagian->keterangan }}</td>
                                            <td><img src="{{ asset('pembagian/' . $pembagian->foto) }}" alt="Foto Pembagian" height="100" width="100"></td>
                                            <td>{{ $pembagian->inputed_by }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('pembagian.edit', $pembagian->id) }}" class="btn btn-warning btn-circle"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delete-pembagian-{{ $pembagian->id }}"><i class="fa fa-trash"></i></button>
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

    @foreach ($data as $pembagian)
    <!-- Delete -->
    <div id="delete-pembagian-{{ $pembagian->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="delete-pembagian-{{ $pembagian->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('pembagian.destroy', $pembagian->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" class="form-control" name="id" value="{{ $pembagian->id }}"><br>
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
