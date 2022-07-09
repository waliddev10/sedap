@extends('layouts.app')

@section('title', 'Arsip Penugasan')
@section('title.category', 'General')

@section('content')
<div class="row">
    <div class="col-xl-3 box-col-6 pe-0">
        <div class="file-sidebar">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            <div class="btn btn-primary">
                                Beranda
                            </div>
                        </li>
                        <li>
                            <div class="btn btn-light">
                                Telaahan Staf
                            </div>
                        </li>
                        <li>
                            <div class="btn btn-light">
                                Surat Perintah Tugas
                            </div>
                        </li>
                        <li>
                            <div class="btn btn-light">
                                Daftar Absensi
                            </div>
                        </li>
                        <li>
                            <div class="btn btn-light">
                                Laporan Hasil
                            </div>
                        </li>
                        <li>
                            <div class="btn btn-light">
                                Cost Sheet
                            </div>
                        </li>
                    </ul>
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
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-md-12 box-col-12">
        <div class="file-content">
            <div class="card">
                <div class="card-header">
                    <div class="media">
                        <form class="form-inline" action="#" method="get">
                            <div class="form-group mb-0">
                                <i class="fa fa-search"></i>
                                <input class="form-control-plaintext" type="text" placeholder="Cari berkas di sini..."
                                    data-bs-original-title="" title="">
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <div class="media-body text-end">
                            <form class="d-inline-flex" action="#" method="POST" enctype="multipart/form-data"
                                name="myForm">
                                <div class="btn btn-primary" onclick="getFile()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-upload">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                    Unggah Berkas
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body file-manager">
                    <h4 class="mb-3">Semua Berkas</h4>
                    <h6>Terakhir unggah</h6>
                    <ul class="files">
                        <li class="file-box">
                            <div class="file-top"> <i class="fa fa-file-image-o txt-primary"></i><i
                                    class="fa fa-ellipsis-v f-14 ellips"></i></div>
                            <div class="file-bottom">
                                <h6>Logo.psd </h6>
                                <p class="mb-1">2.0 MB</p>
                            </div>
                        </li>
                        <li class="file-box">
                            <div class="file-top"> <i class="fa fa-file-archive-o txt-secondary"></i><i
                                    class="fa fa-ellipsis-v f-14 ellips"></i></div>
                            <div class="file-bottom">
                                <h6>Project.zip </h6>
                                <p class="mb-1">1.90 GB</p>
                            </div>
                        </li>
                        <li class="file-box">
                            <div class="file-top"> <i class="fa fa-file-excel-o txt-success"></i><i
                                    class="fa fa-ellipsis-v f-14 ellips"></i></div>
                            <div class="file-bottom">
                                <h6>Backend.xls</h6>
                                <p class="mb-1">2.00 GB</p>
                            </div>
                        </li>
                        <li class="file-box">
                            <div class="file-top"> <i class="fa fa-file-text-o txt-info"></i><i
                                    class="fa fa-ellipsis-v f-14 ellips"></i></div>
                            <div class="file-bottom">
                                <h6>requirements.txt </h6>
                                <p class="mb-1">0.90 KB</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
