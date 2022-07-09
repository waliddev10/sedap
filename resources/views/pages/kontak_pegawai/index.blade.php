@extends('layouts.app')

@section('title', 'Profil Pegawai')
@section('title.category', 'General')

@section('content')
<div class="row second-chart-list third-news-update">
    <div class="col-xl-12 appointment">
        <div class="card">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5 class="m-0">Profil Pegawai</h5>
                </div>
                <form id="filter" class="form-inline mt-3">
                    <div class="me-2">
                        <select name="bidang_id" class="form-select">
                            <option value="" selected>Semua Bidang</option>
                            @foreach ($bidang as $bid)
                            <option value="{{ $bid->id }}">{{ $bid->nama
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter fa-fw"></i> Filter</button>
                </form>
            </div>
            <div id="list" class="card-body pt-0"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function (){
        loadList();
    });
    function loadList() {
        var container = $('#list');
        $.ajax({
            url: '{{ route('profil_pegawai.index') }}',
            data: $('#filter').serialize(),
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
