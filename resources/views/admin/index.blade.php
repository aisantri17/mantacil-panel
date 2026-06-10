@extends('layouts.admin')

@section('title')
    Administration
@endsection

@section('content-header')
    <h1>Ikhtisar Administratif<small>Pandangan cepat sistem Anda.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Ikhtisar</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box
            @if($version->isLatestPanel())
                box-success
            @else
                box-danger
            @endif
        ">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Sistem</h3>
            </div>
            <div class="box-body">
                @if ($version->isLatestPanel())
                    Anda menjalankan Panel MantaCil versi <code>{{ config('app.version') }}</code>. Panel Anda sudah yang terbaru!
                @else
                    Panel Anda <strong>belum diperbarui!</strong> Versi terbaru adalah <a href="https://github.com/MantaCil/Panel/releases/v{{ $version->getPanel() }}" target="_blank"><code>{{ $version->getPanel() }}</code></a> dan Anda saat ini menjalankan versi <code>{{ config('app.version') }}</code>.
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDiscord() }}"><button class="btn btn-warning" style="width:100%;"><i class="fa fa-fw fa-support"></i> Bantuan <small>(via Discord)</small></button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://mantacil.io"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-link"></i> Dokumentasi</button></a>
    </div>
    <div class="clearfix visible-xs-block">&nbsp;</div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="https://github.com/mantacil/panel"><button class="btn btn-primary" style="width:100%;"><i class="fa fa-fw fa-support"></i> GitHub</button></a>
    </div>
    <div class="col-xs-6 col-sm-3 text-center">
        <a href="{{ $version->getDonations() }}"><button class="btn btn-success" style="width:100%;"><i class="fa fa-fw fa-money"></i> Dukung Proyek Ini</button></a>
    </div>
</div>
@endsection
