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
                    <a href="{{ route('penanaman.create') }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</a>
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
                                        <th rowspan="2" style="text-align: center;vertical-align: middle;">No</th>
                                        <th rowspan="2" style="text-align: center;vertical-align: middle;">Hari/Tgl</th>
                                        <th colspan="5" style="text-align: center;">Penanaman</th>
                                        <th colspan="4" style="text-align: center;">Pembagian Bibit</th>
                                    </tr>
                                    <tr style="text-align: center;">
                                        <th>Jenis Bibit</th>
                                        <th>Jumlah Bibit (Batang)</th>
                                        <th>Pelaksana</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                        <th>Jenis Bibit</th>
                                        <th>Jumlah Bibit (Batang)</th>
                                        <th>Lokasi</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dataPenanaman as $index => $penanaman)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $penanaman->hari }}, {{ $penanaman->tanggalFormat }}</td>
                                            <td>{{ $penanaman->bibit->bibit }}</td>
                                            <td>{{ $penanaman->jumlah }}</td>
                                            <td>{{ $penanaman->pelaksana }}</td>
                                            <td>{{ $penanaman->lokasi }}</td>
                                            <td>{{ $penanaman->keterangan }}</td>
                                            <td>
                                                @if(isset($dataPembagian[$index]))
                                                    {{ $dataPembagian[$index]->bibit->bibit }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($dataPembagian[$index]))
                                                    {{ $dataPembagian[$index]->jumlah }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($dataPembagian[$index]))
                                                    {{ $dataPembagian[$index]->lokasi }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($dataPembagian[$index]))
                                                    {{ $dataPembagian[$index]->keterangan }}
                                                @endif
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

@endsection
