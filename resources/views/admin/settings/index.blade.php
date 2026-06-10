@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'basic'])

@section('title')
    Settings
@endsection

@section('content-header')
    <h1>Pengaturan Panel<small>Konfigurasi MantaCil sesuai keinginan Anda.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Pengaturan</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Pengaturan Panel</h3>
                </div>
                <form action="{{ route('admin.settings') }}" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Nama Perusahaan</label>
                                <div>
                                    <input type="text" class="form-control" name="app:name" value="{{ old('app:name', config('app.name')) }}" />
                                    <p class="text-muted"><small>Ini adalah nama yang digunakan di seluruh panel dan dalam email yang dikirim ke klien.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Wajibkan Otentikasi 2-Faktor (2FA)</label>
                                <div>
                                    <div class="btn-group" data-toggle="buttons">
                                        @php
                                            $level = old('mantacil:auth:2fa_required', config('mantacil.auth.2fa_required'));
                                        @endphp
                                        <label class="btn btn-primary @if ($level == 0) active @endif">
                                            <input type="radio" name="mantacil:auth:2fa_required" autocomplete="off" value="0" @if ($level == 0) checked @endif> Tidak Wajib
                                        </label>
                                        <label class="btn btn-primary @if ($level == 1) active @endif">
                                            <input type="radio" name="mantacil:auth:2fa_required" autocomplete="off" value="1" @if ($level == 1) checked @endif> Khusus Admin
                                        </label>
                                        <label class="btn btn-primary @if ($level == 2) active @endif">
                                            <input type="radio" name="mantacil:auth:2fa_required" autocomplete="off" value="2" @if ($level == 2) checked @endif> Semua Pengguna
                                        </label>
                                    </div>
                                    <p class="text-muted"><small>Jika diaktifkan, akun apa pun yang termasuk dalam grup yang dipilih akan diwajibkan untuk mengaktifkan Otentikasi 2-Faktor guna menggunakan Panel.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Bahasa Default</label>
                                <div>
                                    <select name="app:locale" class="form-control">
                                        @foreach($languages as $key => $value)
                                            <option value="{{ $key }}" @if(config('app.locale') === $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-muted"><small>Bahasa bawaan yang digunakan saat merender komponen antarmuka pengguna.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {!! csrf_field() !!}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
