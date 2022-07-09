@extends('layouts.app')

@section('title', 'Beranda')
@section('title.category', 'General')

@section('content')
<div class="row">
    <div class="col-xl-3 box-col-6 pe-0">
        <div class="file-sidebar">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            <a href="{{ route('dashboard.index') }}" class="btn btn-light">
                                Beranda
                            </a>
                        </li>
                        @foreach($kategori_arsip as $kategori)
                        <li>
                            <a href="{{ route('dashboard.show', $kategori->id) }}"
                                class="btn @if($item->id == $kategori->id) btn-primary @else btn-light @endif">
                                {{ $kategori->nama }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    {{--
                    <hr>
                    <ul>
                        <li>
                            <div class="m-t-15">
                                <div class="progress sm-progress-bar mb-1">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 25%"
                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p>Total 25 GB telah digunakan</p>
                            </div>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-12 box-col-12">
        <div class="file-content">
            <div class="card">
                <div class="card-header">
                    <div class="media">
                        <form class="form-inline" action="{{ route('dashboard.show', $item->id) }}" method="get">
                            <div class="form-group mb-0">
                                <i class="fa fa-search"></i>
                                <input name="search" class="form-control-plaintext" type="text"
                                    placeholder="Cari tahun atau judul..." data-bs-original-title="" title="">
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <div class="media-body text-end">
                            <a class="btn btn-primary" title="Tambah Berkas" data-bs-toggle="modal"
                                data-bs-target="#modalContainer" data-title="Tambah Berkas"
                                href="{{ route('dashboard.create') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-upload">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                Unggah Berkas
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body file-manager">
                    <h4 class="mb-3">{{ $item->nama }}</h4>
                    <h6>{{ request()->search ? 'Pencarian atas "' . request()->search . '"' : 'Terakhir unggah' }}</h6>
                    <ul class="files">
                        @foreach($arsip as $item)
                        <li class="file-box">
                            <div class="file-top">
                                <i class="fa
                                @if(\File::extension($item->file) == 'jpg' || \File::extension($item->file) == 'jpeg' || \File::extension($item->file) == 'png') fa-file-image-o txt-success @endif
                                @if(\File::extension($item->file) == 'xlsx' || \File::extension($item->file) == 'xls') fa-file-excel-o txt-success @endif
                                @if(\File::extension($item->file) == 'pdf') fa-file-pdf-o txt-secondary @endif
                                @if(\File::extension($item->file) == 'doc' || \File::extension($item->file) == 'docx') fa-file-word-o txt-linkedin @endif
                                "></i>
                                <a href="{{ route('dashboard.download', $item->id) }}"><i
                                        class="fa fa-download f-14 ellips"></i></a>
                            </div>
                            <div class="file-bottom">
                                <h6>{{ $item->nama }}</h6>
                                <p class="mb-1">{{ $item->file }} • <i>{{ $item->tgl_berkas
                                        }}</i></p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContainer" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalContainer" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Title</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                ...
            </div>
        </div>
    </div>
</div>
@endsection
