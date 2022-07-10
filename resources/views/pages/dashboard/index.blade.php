@extends('layouts.app')

@section('title', 'Beranda')
@section('title.category', 'General')

@section('content')
<div class="row">
    <div class="col pe-0">
        <div class="card">
            <div class="card-body">
                <img class="img-fluid" src="{{ asset('assets/infografis.png') }}" />
            </div>
        </div>
    </div>
</div>
@endsection
