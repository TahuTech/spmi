@extends('template.BaseView')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kriteria {{ $j->name }}</h6>
                </div>
                <div class="card-body">
                    @if (session()->has('pesan'))
                        {!! session()->get('pesan') !!}
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($c as $i)
                                    <tr>
                                        <td>{{ $i->name }}</td>
                                        <td width="150px">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                                data-target="#modelEdit{{ $i->id }}">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#modelHapus{{ $i->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- EDIT DATA --}}
                                    <div class="modal fade" id="modelEdit{{ $i->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="/kriteria/put/{{ $i->id }}" method="POST">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Kriteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <label for="">Nama Kriteria</label>
                                                            <input type="text" name="name" class="form-control"
                                                                aria-describedby="helpId" value="{{ $i->name }}"
                                                                required>
                                                            <input type="text" name="jenjang" hidden class="form-control"
                                                                value="{{ $j->id }}" required>
                                                            <input type="text" name="url" hidden class="form-control"
                                                                value="{{ request()->url() }}" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- HAPUS DATA --}}
                                    <div class="modal fade" id="modelHapus{{ $i->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="/kriteria/hapus/{{ $i->id }}" method="post">
                                                <input type="text" name="url" hidden class="form-control"
                                                    value="{{ request()->url() }}" required>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Hapus Kriteria</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @csrf
                                                        @method('delete')
                                                        Apa kamu yakin akan menghapus data <b>{{ $i->name }}</b>
                                                        penghapusan data bersifat permanet,
                                                        dan mungkin akan mengakibatkan kerusakan pada sistem yang
                                                        menggunakan data berelasi.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Tetap Hapus
                                                            !!!</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Aksi</h4>
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                        data-target="#modelTambah">
                        Tambah Kriteria
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelTambah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="/kriteria/store" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Butir Kriteria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="">Nama Level 1</label>
                            <input type="text" name="name" class="form-control" placeholder="C1 - Nama"
                                aria-describedby="helpId" required>
                            <input type="text" name="jenjang" hidden class="form-control" value="{{ $j->id }}"
                                required>
                            <input type="text" name="url" hidden class="form-control" value="{{ request()->url() }}"
                                required>
                            <small id="helpId" class="text-muted">Isi dengan format C1 - Nama</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
