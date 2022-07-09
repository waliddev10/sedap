<form action="{{ route('penugasan.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation"
    id="editForm" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Nama/Judul Penugasan</label>
                <textarea name="nama" rows="1" class="form-control input-air-primary">{{ $item->nama }}</textarea>
            </div>
            <div class="mt-2">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control input-air-primary"
                    value="{{ $item->tgl_mulai }}" />
            </div>
            <div class="mt-2">
                <label class="form-label">Tanggal Selesai</label>
                <input type="date" name="tgl_selesai" class="form-control input-air-primary"
                    value="{{ $item->tgl_selesai }}" />
            </div>
            <div class="mt-2">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control input-air-primary">{{ $item->keterangan }}</textarea>
            </div>
            <div class="mt-2">
                <label class="form-label">Lokasi</label>
                <textarea name="lokasi" rows="1" class="form-control input-air-primary">{{ $item->lokasi }}</textarea>
            </div>
        </div>
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Jenis Penugasan</label>
                <select name="jenis_penugasan_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Jenis Penugasan</option>
                    @foreach ($jenis_penugasan as $jenis_penugasan)
                    <option value="{{ $jenis_penugasan->id }}" @if($jenis_penugasan->id == $item->jenis_penugasan_id)
                        selected @endif>{{ $jenis_penugasan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">Kategori Penugasan</label>
                <select name="kategori_penugasan_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Kategori Penugasan</option>
                    @foreach ($kategori_penugasan as $kategori_penugasan)
                    <option value="{{ $kategori_penugasan->id }}" @if($kategori_penugasan->id ==
                        $item->kategori_penugasan_id) selected @endif>{{ $kategori_penugasan->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">SKPD</label>
                <select name="skpd_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih SKPD</option>
                    @foreach ($skpd as $skpd)
                    <option value="{{ $skpd->id }}" @if($skpd->id == $item->skpd_id) selected @endif>{{ $skpd->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">Bidang</label>
                <select name="bidang_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Bidang</option>
                    @foreach ($bidang as $bidang)
                    <option value="{{ $bidang->id }}" @if($bidang->id == $item->bidang_id) selected @endif>{{
                        $bidang->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="mt-5 text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Ubah Data</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    $("#editForm").on('submit', function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#modalContainer").modal('hide');
                tableDokumen.ajax.reload(null, false);
                showAlert(response.message, response.status || 'success');
            },
            error: function(xhr) {
                var err = eval("(" + xhr.responseText + ")");
                showAlert(err.message, err.status || 'error');
            }
        });
        return false;
    });
</script>
