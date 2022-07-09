@extends('layouts.app')

@section('title', 'Kalender Penugasan')
@section('title.category', 'General')

@section('content')
<div class="row second-chart-list third-news-update">
    <div class="col-xl-3 col-lg-6 xl-50 calendar-sec box-col-6">
        <div class="card gradient-primary o-hidden">
            <div class="card-body">
                <div class="default-datepicker">
                    <div id="kalender_penugasan" class="datepicker-here" data-language="en"></div>
                </div><span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span
                            class="dots dots1"></span><span class="dots dots2 dot-small"></span><span
                            class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span
                            class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span
                            class="dots dots7 dot-small-semi"></span><span
                            class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">
                        </span></span></span>
            </div>
        </div>
    </div>
    <div class="col-xl-9 col-lg-6 xl-50 box-col-6">
        <div class="row mb-3">
            <div class="col-xl-12 col-lg-12 box-col-12">
                <h4 id="judul"></h4>
            </div>
        </div>
        <div id="list" class="row"></div>
    </div>
</div>
@endsection


@push('scripts')
<script type="text/javascript">
    $(document).ready(function (){
        var currentDate = new Date();
        const penanggalan = new Date();
        penanggalan.setMonth(currentDate.getMonth());
        const bulan = penanggalan.toLocaleString('id-ID', {
            month: 'long',
        });
        $('#judul').html('Penugasan Bulan ' + bulan + ' ' + currentDate.getFullYear());
        loadList(currentDate.getMonth() + 1, currentDate.getFullYear());
    });
    $('#kalender_penugasan').datepicker({
        todayButton: new Date(),
        onSelect: function(formatedDate, date) {
            const penanggalan = new Date();
            penanggalan.setMonth(date.getMonth());
            const bulan = penanggalan.toLocaleString('id-ID', {
                month: 'long',
            });

            loadList(date.getMonth() + 1, date.getFullYear());
            $('#judul').html('Penugasan Bulan ' + bulan + ' ' + date.getFullYear());
        }
    });
    function loadList(bulan, tahun) {
        var container = $('#list');
        $.ajax({
            url: '{{ route('kalender_penugasan.index') }}',
            data: { bulan, tahun },
            type: 'GET',
            beforeSend: function() {
                container.html(setLoader())
            },
            success: function(response){
                container.html(response)
            }
        });
    }
    $('#filter').on('submit', function(e) {
        e.preventDefault();
        loadList();
    });
</script>
@endpush
