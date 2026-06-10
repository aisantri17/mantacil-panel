@extends('layouts.admin')

@section('title')
    Database Hosts
@endsection

@section('content-header')
    <h1>Host Database<small>Host database tempat server dapat membuat databasenya.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Host Database</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Daftar Host</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHostModal">Buat Baru</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Host</th>
                            <th>Port</th>
                            <th>Nama Pengguna (Username)</th>
                            <th class="text-center">Database</th>
                            <th class="text-center">Node</th>
                        </tr>
                        @foreach ($hosts as $host)
                            <tr>
                                <td><code>{{ $host->id }}</code></td>
                                <td><a href="{{ route('admin.databases.view', $host->id) }}">{{ $host->name }}</a></td>
                                <td><code>{{ $host->host }}</code></td>
                                <td><code>{{ $host->port }}</code></td>
                                <td>{{ $host->username }}</td>
                                <td class="text-center">{{ $host->databases_count }}</td>
                                <td class="text-center">
                                    @if(! is_null($host->node))
                                        <a href="{{ route('admin.nodes.view', $host->node->id) }}">{{ $host->node->name }}</a>
                                    @else
                                        <span class="label label-default">Tidak Ada</span>
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
<div class="modal fade" id="newHostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.databases') }}" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Buat Host Database Baru</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Nama</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">Pengidentifikasi singkat yang digunakan untuk membedakan lokasi ini dari yang lain. Harus antara 1 hingga 60 karakter, contohnya <code>us.nyc.lvl3</code>.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">Host</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">Alamat IP atau FQDN yang akan digunakan saat mencoba terhubung ke host MySQL ini <em>dari panel</em> untuk menambahkan database baru.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">Port</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">Port tempat MySQL berjalan untuk host ini.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">Nama Pengguna (Username)</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">Nama pengguna dari akun yang memiliki cukup izin untuk membuat pengguna dan database baru di sistem.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">Kata Sandi (Password)</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">Kata sandi ke akun yang ditentukan.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Node Tertaut</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">Tidak Ada</option>
                            @foreach($locations as $location)
                                <optgroup label="{{ $location->short }}">
                                    @foreach($location->nodes as $node)
                                        <option value="{{ $node->id }}">{{ $node->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <p class="text-muted small">Pengaturan ini tidak melakukan apa pun selain menggunakan default host database ini saat menambahkan database ke server pada node yang dipilih.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">Akun yang ditentukan untuk host database ini <strong>harus</strong> memiliki izin <code>WITH GRANT OPTION</code>. Jika akun yang ditentukan tidak memiliki izin ini, permintaan untuk membuat database <em>akan</em> gagal. <strong>Jangan gunakan detail akun yang sama untuk MySQL yang telah Anda tetapkan untuk panel ini.</strong></p>
                    {!! csrf_field() !!}
                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Buat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('#pNodeId').select2();
    </script>
@endsection
