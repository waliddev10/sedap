@forelse($items as $item)
<div class="card">
    @if(\Carbon\Carbon::parse($item->penugasan->tgl_mulai) <= \Carbon\Carbon::now() && \Carbon\Carbon::parse($item->
        penugasan->tgl_selesai) <= \Carbon\Carbon::now()) <div
            class="ribbon ribbon-bookmark ribbon-vertical-left ribbon-primary"><i class="fa fa-check-circle"></i></div>
@elseif(\Carbon\Carbon::parse($item->penugasan->tgl_mulai) <= \Carbon\Carbon::now() && \Carbon\Carbon::parse($item->
    penugasan->tgl_selesai) > \Carbon\Carbon::now()) <div
        class="ribbon ribbon-bookmark ribbon-vertical-left ribbon-warning"><i class="fa fa-clock-o"></i>
    </div>
    @endif

    <div class="job-search">
        <div class="card-body">
            <div class="media">
                <img class="img-40 img-fluid m-r-20" src="{{ asset('assets/images/job-search/1.jpg') }}" alt="">
                <div class="media-body">
                    <h6 class="f-w-600">
                        <a href="javascript:void(0)">{{ $item->penugasan->nama }}</a>

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
                        <strong>SKPD:</strong> {{ $item->penugasan->skpd->nama }} ({{
                        $item->penugasan->lokasi
                        }})
                    </p>
                </div>
            </div>
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
