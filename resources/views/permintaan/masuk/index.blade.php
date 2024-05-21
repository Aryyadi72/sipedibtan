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
                    <button type="button" data-toggle="modal" data-target="#add-pm" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('filter.masuk') }}" method="POST">
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
                                        <th>Nama</th>
                                        <th>Bibit</th>
                                        <th>Jumlah</th>
                                        <th>Ketersediaan Bibit</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datapm as $key => $pm)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pm->masuk_tgl)->format('d-m-Y') }}</td>
                                            <td>{{ $pm->nama }}</td>
                                            <td>{{ $pm->bibit }}</td>
                                            @if ($pm->jumlah <= $pm->total_jumlah)
                                                <td>
                                                    <button type="button" class="btn btn-success btn-rounded"><i
                                                        class="fas fa-check-circle"></i> {{ $pm->jumlah }}</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-rounded"><i
                                                        class="fas fa-times-circle"></i> {{ $pm->jumlah }}</button>
                                                </td>
                                            @endif
                                            @if ($pm->total_jumlah > 0)
                                                <td>
                                                    <button type="button" class="btn btn-success btn-rounded"><i
                                                        class="fas fa-check-circle"></i> Tersedia : {{ $pm->total_jumlah }}</button>
                                                </td>
                                            @else
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-rounded"><i
                                                        class="fas fa-times-circle"></i> Tidak Tersedia</button>
                                                </td>
                                            @endif
                                            @if ($pm->status == 'Masuk')
                                            <td>
                                                <button type="button" class="btn btn-cyan btn-rounded"><i
                                                    class="fas fa-arrow-alt-circle-right"></i> {{ $pm->status }}</button>
                                            </td>
                                            @elseif ($pm->status == 'Selesai')
                                            <td>
                                                <button type="button" class="btn btn-success btn-rounded"><i
                                                    class="fas fa-check-circle"></i> {{ $pm->status }}</button>
                                            </td>
                                            @else
                                            <td>
                                                <button type="button" class="btn btn-danger btn-rounded"><i
                                                    class="fas fa-times-circle"></i> {{ $pm->status }}</button>
                                                </td>
                                            @endif
                                            <td class="text-center">
                                                @if ($pm->jumlah <= $pm->total_jumlah)
                                                    <div style="display: inline-block;">
                                                        <form action="{{ route('keluar.store', ['id' => $pm->masuk_id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-circle" {{ $pm->status != 'Masuk' ? 'disabled' : '' }}><i data-feather="external-link" class="feather-icon"></i></button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <div style="display: inline-block;">
                                                        <form action="{{ route('keluar.store', ['id' => $pm->masuk_id]) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-circle" {{ $pm->status != 'Masuk' ? 'disabled' : '' }} disabled><i data-feather="external-link" class="feather-icon"></i></button>
                                                        </form>
                                                    </div>
                                                @endif

                                                <div style="display: inline-block;">
                                                    <button type="button" data-toggle="modal" data-target="#add-pb-{{ $pm->masuk_id }}" class="btn btn-danger btn-circle {{ $pm->status != 'Masuk' ? 'disabled' : '' }}"><i data-feather="x" class="feather-icon"></i></button>
                                                </div>
                                                {{-- <div style="display: inline-block;">
                                                    <form action="{{ route('batal.store', ['id' => $pm->masuk_id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary btn-circle"><i data-feather="printer" class="feather-icon"></i></button>
                                                    </form>
                                                </div> --}}
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

    <!-- Create -->
    <div id="add-pm" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">Tambah Permintaan Masuk
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('masuk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Bibit</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="exampleFormControlSelect1" name="bibit_id" required>
                                <option selected disabled>Pilih Bibit</option>
                                @foreach ($bibit as $item)
                                    @php
                                        $stok = \App\Models\BibitMasuk::where('bibit_id', $item->id)->sum('stok');
                                    @endphp
                                    <option value="{{ $item->id }}" {{ $stok == 0 ? 'disabled' : '' }}>
                                        {{ $item->bibit }} {{ $stok == 0 ? '(Stok Habis)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Jumlah</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" name="jumlah" required>
                        </div>

                        <input type="hidden" class="form-control" name="status" value="Masuk">
                        <input type="hidden" class="form-control" name="users_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" class="form-control" name="inputed_by" value="{{ $biodata->nama }}">

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

    @foreach ($datapm as $pm)
    <!-- Create Batal -->
    <div id="add-pb-{{ $pm->masuk_id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="add-pb-{{ $pm->masuk_id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="primary-header-modalLabel">Tambahkan Catatan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('batal.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" class="form-control" name="pm_id" value="{{ $pm->masuk_id }}">
                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Catatan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="catatan" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
