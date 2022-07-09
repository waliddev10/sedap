<form action="{{ route('bidang.store') }}" accept-charset="UTF-8" class="form needs-validation" id="create"
    autocomplete="off">
    @csrf
    <div class="row">
        <div class="col">
            <div class="mt-2">
                <label class="form-label">Nama Bidang</label>
                <input type="text" name="nama" class="form-control input-air-primary" />
            </div>
        </div>
    </div>

    <div class="text-right mt-5">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
    </div>

</form>

<script type="text/javascript">
    $("#create").on('submit', function(event) {
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
