@extends('layouts.admin')

@section('title')
    Nests
@endsection

@section('content-header')
    <h1>Sarang (Nests)<small>Semua sarang yang saat ini tersedia di sistem ini.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Sarang</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-danger">
            Egg adalah fitur andalan dari Panel MantaCil yang memungkinkan fleksibilitas dan konfigurasi tingkat tinggi. Harap diingat bahwa meskipun sangat berguna, memodifikasi egg dengan cara yang salah dapat merusak server Anda dan menyebabkan banyak masalah. Harap hindari mengedit egg bawaan kami — yang disediakan oleh <code>support@mantacil.io</code> — kecuali jika Anda benar-benar yakin dengan apa yang Anda lakukan.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Sarang Terkonfigurasi</h3>
                <div class="box-tools">
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#importServiceOptionModal" role="button"><i class="fa fa-upload"></i> Impor Egg</a>
                    <a href="{{ route('admin.nests.new') }}" class="btn btn-primary btn-sm">Buat Baru</a>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Eggs</th>
                        <th class="text-center">Server</th>
                    </tr>
                    @foreach($nests as $nest)
                        <tr>
                            <td class="middle"><code>{{ $nest->id }}</code></td>
                            <td class="middle"><a href="{{ route('admin.nests.view', $nest->id) }}" data-toggle="tooltip" data-placement="right" title="{{ $nest->author }}">{{ $nest->name }}</a></td>
                            <td class="col-xs-6 middle">{{ $nest->description }}</td>
                            <td class="text-center middle">{{ $nest->eggs_count }}</td>
                            <td class="text-center middle">{{ $nest->servers_count }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="importServiceOptionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Impor sebuah Egg</h4>
            </div>
            <form action="{{ route('admin.nests.egg.import') }}" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="pImportFile">File Egg <span class="field-required"></span></label>
                        <div>
                            <input id="pImportFile" type="file" name="import_file" class="form-control" accept="application/json" />
                            <p class="small text-muted">Pilih file <code>.json</code> untuk egg baru yang ingin Anda impor.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="pImportToNest">Sarang (Nest) Terkait <span class="field-required"></span></label>
                        <div>
                            <select id="pImportToNest" name="import_to_nest">
                                @foreach($nests as $nest)
                                   <option value="{{ $nest->id }}">{{ $nest->name }} &lt;{{ $nest->author }}&gt;</option>
                                @endforeach
                            </select>
                            <p class="small text-muted">Pilih sarang yang akan dikaitkan dengan egg ini dari daftar. Jika Anda ingin mengaitkannya dengan sarang baru, Anda harus membuat sarang tersebut sebelum melanjutkan.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Impor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#pImportToNest').select2();
        });
    </script>
@endsection
