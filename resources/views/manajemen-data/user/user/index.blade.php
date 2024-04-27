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
                    <button type="button" data-toggle="modal" data-target="#add-user" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Tambah</button>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->nama_biodata }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->level }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit-user-{{ $user->id }}"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#delete-user"><i class="fa fa-trash"></i></button>
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
    <div id="add-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="nama">
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="email">
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Password</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="password">
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Level</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="exampleFormControlSelect1" name="level">
                                <option selected disabled>Pilih Level</option>
                                <option value="Superadmin">Superadmin</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Diinputkan oleh</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="inputed_by">
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
    @foreach ($data as $user)
    <div id="edit-user-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="edit-user-{{ $user->id }}-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-warning">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Edit
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Password</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="password">
                        </div>

                        <label for="inputHorizontalSuccess" class="col-sm-12 col-form-label">Level</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="exampleFormControlSelect1" name="level">
                                <option selected disabled>Pilih Level</option>
                                <option value="Superadmin" {{ $user->level == 'Superadmin' ? 'selected' : '' }}>Superadmin</option>
                                <option value="Admin" {{ $user->level == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="User" {{ $user->level == 'User' ? 'selected' : '' }}>User</option>
                            </select>
                        </div>

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
    <div id="delete-user" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="primary-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-danger">
                    <h4 class="modal-title" id="primary-header-modalLabel">{{ $title }} - Tambah
                    </h4>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×</button>
                </div>
                <form action="{{ route('bibit.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" class="form-control" name="id" value="{{ $user->id }}"><br>
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
