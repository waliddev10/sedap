<form action="{{ route('jenis_penugasan.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation"
    id="editForm" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Nama Jenis Penugasan</label>
                <input type="text" name="nama" class="form-control input-air-primary" value="{{ $item->nama }}" />
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
