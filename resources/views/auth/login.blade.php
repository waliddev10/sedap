@extends('layouts.guest')

@section('content')
<div>
    <div class="login-main">
        <form method="POST" action="{{ route('login') }}" class="theme-form">
            @csrf
            <a class="logo">
                <img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt="logo login">
            </a>
            <h4>Sistem Arsip Data Penugasan
                Bidang Perekonomian</h4>
            <p>Inspektorat Provinsi Kalimantan Timur</p>
            <div class="form-group">
                <label class="col-form-label">Username</label>
                <input autofocus required type="text" name="username" class="form-control" placeholder="Username"
                    value="{{ old('username') }}" />
                @error('username')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label class="col-form-label">Password</label>
                <input required type="password" name="password" class="form-control" placeholder="Password" />
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-0">
                <div class="checkbox p-0">
                    <input id="checkbox1" type="checkbox" name="remember">
                    <label class="text-muted" for="checkbox1">Simpan Informasi Login</label>
                </div>
                <div class="text-end mt-3">
                    <button class="btn btn-lg btn-primary btn-block w-100" type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
    <div class="text-center mt-3">
        <object style="width:150px;" type="image/svg+xml" data="{{ asset('assets/images/digicert.svg') }}"></object>
    </div>
</div>
@endsection
