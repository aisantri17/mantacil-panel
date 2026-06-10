
@extends('layouts.admin')

@section('title')
    Mounts
@endsection

@section('content-header')
    <h1>Mount<small>Konfigurasikan dan kelola titik pemasangan (mount points) tambahan untuk server.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Mount</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Mount</h3>

                    <div class="box-tools">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newMountModal">Buat Baru</button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Sumber (Source)</th>
                                <th>Target</th>
                                <th class="text-center">Eggs</th>
                                <th class="text-center">Node</th>
                                <th class="text-center">Server</th>
                            </tr>

                            @foreach ($mounts as $mount)
                                <tr>
                                    <td><code>{{ $mount->id }}</code></td>
                                    <td><a href="{{ route('admin.mounts.view', $mount->id) }}">{{ $mount->name }}</a></td>
                                    <td><code>{{ $mount->source }}</code></td>
                                    <td><code>{{ $mount->target }}</code></td>
                                    <td class="text-center">{{ $mount->eggs_count }}</td>
                                    <td class="text-center">{{ $mount->nodes_count }}</td>
                                    <td class="text-center">{{ $mount->servers_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newMountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.mounts') }}" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #FFFFFF">&times;</span>
                        </button>

                        <h4 class="modal-title">Buat Mount</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pName" class="form-label">Nama</label>
                                <input type="text" id="pName" name="name" class="form-control" />
                                <p class="text-muted small">Nama unik yang digunakan untuk membedakan mount ini dengan yang lain.</p>
                            </div>

                            <div class="col-md-12">
                                <label for="pDescription" class="form-label">Deskripsi</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="4"></textarea>
                                <p class="text-muted small">Deskripsi yang lebih panjang untuk mount ini, harus kurang dari 191 karakter.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pSource" class="form-label">Sumber (Source)</label>
                                <input type="text" id="pSource" name="source" class="form-control" />
                                <p class="text-muted small">Jalur file di sistem host yang akan dipasang ke sebuah kontainer.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pTarget" class="form-label">Target</label>
                                <input type="text" id="pTarget" name="target" class="form-control" />
                                <p class="text-muted small">Di mana mount ini akan dapat diakses di dalam sebuah kontainer.</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Hanya Baca (Read Only)</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pReadOnlyFalse" name="read_only" value="0" checked>
                                        <label for="pReadOnlyFalse">Tidak</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pReadOnly" name="read_only" value="1">
                                        <label for="pReadOnly">Ya</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Apakah mount ini hanya dapat dibaca di dalam kontainer?</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Bisa Dipasang Oleh Pengguna (User Mountable)</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pUserMountableFalse" name="user_mountable" value="0" checked>
                                        <label for="pUserMountableFalse">Tidak</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pUserMountable" name="user_mountable" value="1">
                                        <label for="pUserMountable">Ya</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Apakah pengguna seharusnya dapat memasang ini sendiri?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        {!! csrf_field() !!}
                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success btn-sm">Buat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
