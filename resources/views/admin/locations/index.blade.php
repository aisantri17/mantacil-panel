@extends('layouts.admin')

@section('title')
    Locations
@endsection

@section('content-header')
    <h1>Lokasi<small>Semua lokasi yang dapat ditetapkan ke node untuk mempermudah kategorisasi.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Lokasi</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Lokasi</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newLocationModal">Buat Baru</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Kode Singkat</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Node</th>
                            <th class="text-center">Server</th>
                        </tr>
                        @foreach ($locations as $location)
                            <tr>
                                <td><code>{{ $location->id }}</code></td>
                                <td><a href="{{ route('admin.locations.view', $location->id) }}">{{ $location->short }}</a></td>
                                <td>{{ $location->long }}</td>
                                <td class="text-center">{{ $location->nodes_count }}</td>
                                <td class="text-center">{{ $location->servers_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newLocationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.locations') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Buat Lokasi</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pShortModal" class="form-label">Kode Singkat</label>
                            <input type="text" name="short" id="pShortModal" class="form-control" />
                            <p class="text-muted small">Pengidentifikasi singkat yang digunakan untuk membedakan lokasi ini dengan lokasi lain. Harus terdiri dari 1 hingga 60 karakter, contohnya <code>us.nyc.lvl3</code>.</p>
                        </div>
                        <div class="col-md-12">
                            <label for="pLongModal" class="form-label">Deskripsi</label>
                            <textarea name="long" id="pLongModal" class="form-control" rows="4"></textarea>
                            <p class="text-muted small">Deskripsi yang lebih panjang tentang lokasi ini. Maksimal 191 karakter.</p>
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
