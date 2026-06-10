@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    Advanced Settings
@endsection

@section('content-header')
    <h1>Pengaturan Lanjutan<small>Konfigurasikan pengaturan tingkat lanjut untuk MantaCil.</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li class="active">Pengaturan</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">reCAPTCHA</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Status</label>
                                <div>
                                    <select class="form-control" name="recaptcha:enabled">
                                        <option value="true">Aktif</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>Nonaktif</option>
                                    </select>
                                    <p class="text-muted small">Jika diaktifkan, formulir login dan atur ulang kata sandi akan melakukan pemeriksaan captcha secara diam-diam dan menampilkan captcha yang terlihat jika diperlukan.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Site Key</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Secret Key</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                    <p class="text-muted small">Digunakan untuk komunikasi antara situs Anda dan Google. Pastikan untuk merahasiakannya.</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        Anda saat ini menggunakan kunci reCAPTCHA bawaan yang dikirimkan bersama Panel ini. Untuk meningkatkan keamanan, disarankan untuk <a href="https://www.google.com/recaptcha/admin">membuat kunci reCAPTCHA invisible yang baru</a> yang dikhususkan untuk situs web Anda.
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Koneksi HTTP</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Batas Waktu Koneksi (Connection Timeout)</label>
                                <div>
                                    <input type="number" required class="form-control" name="mantacil:guzzle:connect_timeout" value="{{ old('mantacil:guzzle:connect_timeout', config('mantacil.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">Jumlah waktu dalam detik untuk menunggu sambungan dibuka sebelum memunculkan error.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Batas Waktu Permintaan (Request Timeout)</label>
                                <div>
                                    <input type="number" required class="form-control" name="mantacil:guzzle:timeout" value="{{ old('mantacil:guzzle:timeout', config('mantacil.guzzle.timeout')) }}">
                                    <p class="text-muted small">Jumlah waktu dalam detik untuk menunggu permintaan diselesaikan sebelum memunculkan error.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pembuatan Alokasi Otomatis (Automatic Allocation Creation)</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Status</label>
                                <div>
                                    <select class="form-control" name="mantacil:client_features:allocations:enabled">
                                        <option value="false">Nonaktif</option>
                                        <option value="true" @if(old('mantacil:client_features:allocations:enabled', config('mantacil.client_features.allocations.enabled'))) selected @endif>Aktif</option>
                                    </select>
                                    <p class="text-muted small">Jika diaktifkan, pengguna akan memiliki opsi untuk secara otomatis membuat port/alokasi baru untuk server mereka melalui frontend.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Port Awal (Starting Port)</label>
                                <div>
                                    <input type="number" class="form-control" name="mantacil:client_features:allocations:range_start" value="{{ old('mantacil:client_features:allocations:range_start', config('mantacil.client_features.allocations.range_start')) }}">
                                    <p class="text-muted small">Port awal dalam rentang yang dapat dialokasikan secara otomatis.</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Port Akhir (Ending Port)</label>
                                <div>
                                    <input type="number" class="form-control" name="mantacil:client_features:allocations:range_end" value="{{ old('mantacil:client_features:allocations:range_end', config('mantacil.client_features.allocations.range_end')) }}">
                                    <p class="text-muted small">Port akhir dalam rentang yang dapat dialokasikan secara otomatis.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
