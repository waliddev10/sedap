@forelse($items as $item)
<div class="card">
    <div class="job-search">
        <div class="card-body">
            <div class="media">
                <img class="img-60 img-fluid m-r-20" src="{{ asset('assets/images/job-search/1.jpg') }}" alt="">
                <div class="media-body">
                    <h6 class="f-w-600">
                        <a href="javascript:void(0)">{{ $item->penugasan->nama }}</a>
                        @if(\Carbon\Carbon::parse($item->penugasan->tgl_mulai) <= \Carbon\Carbon::now() &&
                            \Carbon\Carbon::parse($item->penugasan->tgl_selesai) <= \Carbon\Carbon::now()) <span
                                class="badge badge-primary pull-right">
                                <i class="fa fa-check-circle"></i> Selesai
                                </span>
                                @elseif(\Carbon\Carbon::parse($item->penugasan->tgl_mulai) <= \Carbon\Carbon::now() &&
                                    \Carbon\Carbon::parse($item->
                                    penugasan->tgl_selesai) > \Carbon\Carbon::now()) <span
                                        class="badge badge-warning pull-right">
                                        <i class="fa fa-clock-o"></i> Sedang Berlangsung
                                    </span>
                                    @endif
                    </h6>
                    <p class="mb-0">
                        <strong>Dari:</strong> {{ \Carbon\Carbon::parse($item->penugasan->tgl_mulai)
                        ->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                    <p class="mb-0">
                        <strong>Sampai:</strong> {{ \Carbon\Carbon::parse($item->penugasan->tgl_selesai)
                        ->isoFormat('dddd, D MMMM YYYY') }}
                    </p>
                    <p class="mb-0">
                        <strong>SKPD:</strong> {{ $item->penugasan->skpd->nama }} ({{ $item->penugasan->lokasi
                        }})
                    </p>
                    <p class="mb-0">
                        <strong>Peran:</strong> {{ $item->jabatan_tim->nama }}
                    </p>
                </div>
            </div>
            <p class="mt-3">
                {{ $item->penugasan->keterangan }}
            </p>
        </div>
    </div>
</div>
@empty
<div class="card">
    <div class="card-body">
        Tidak ada tugas bulan ini.
    </div>
</div>
@endforelse
