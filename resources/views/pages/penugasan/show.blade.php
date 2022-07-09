<div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-7 mb-5">
        <div class="table-responsive">
            <table id="tableDokumenChild" class="display">
                <thead>
                    <tr>
                        <th></th>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jabatan Tim</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="col-sm-5">
        <h5>Tambah Komponen Tim</h5>
        <form action="{{ route('user_penugasan.store') }}" accept-charset="UTF-8" class="form needs-validation"
            id="create" autocomplete="off">
            @csrf
            <input type="hidden" name="penugasan_id" value="{{ $item->id }}" />
            <div class="mt-2">
                <label class="form-label">Nama Pegawai</label>
                <select name="user_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Pegawai</option>
                    @foreach ($user as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-2">
                <label class="form-label">Jabatan dalam Tim</label>
                <select name="jabatan_tim_id" class="form-select input-air-primary">
                    <option disabled selected>Pilih Jabatan dalam Tim</option>
                    @foreach ($jabatan_tim as $jabatan_tim)
                    <option value="{{ $jabatan_tim->id }}">{{ $jabatan_tim->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-right mt-5">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Tambah</button>
            </div>

        </form>
    </div>
</div>
<script type="text/javascript">
    var tableDokumenChild = $('#tableDokumenChild').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('penugasan.show', $item->id) }}',
            // data: function (d) {
            //     d.bulan = $('select[name=bulan]').val();
            //     d.tahun = $('select[name=tahun]').val();
            // }
        },
        columns: [
            { data: 'action', name: 'action', className: 'text-nowrap text-center', width: '1%', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '1%' , searchable: false, orderable: false},
            { data: 'user.nama', name: 'user.nama' },
            { data: 'jabatan_tim.nama', name: 'jabatan_tim.nama' },
        ],
    });

    // $('#search-form').on('submit', function(e) {
    //     tableDokumenChild.draw();
    //     e.preventDefault();
    // });
</script>
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
                tableDokumenChild.ajax.reload(null, false);
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
