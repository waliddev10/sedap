<div class="appointment-table table-responsive">
    <table class="table table-bordernone">
        <tbody>
            @forelse ($items as $user)
            <tr>
                <td class="py-2">
                    <img class="img-fluid img-40 rounded-circle mb-3"
                        src="{{ asset('assets/images/appointment/app-ent.jpg') }}" alt="Image description">
                </td>
                <td class="img-content-box py-2">
                    <span class="d-block">{{ $user->nama }}</span>
                    <span class="font-roboto d-block">{{ $user->email }}</span>
                    <p class="m-0 font-primary">{{ $user->pangkat->nama }} {{
                        $user->pangkat->golongan }}</p>
                </td>
                <td class="py-2">
                    <p class="m-0 font-primary">{{ $user->bidang->nama }}</p>
                    <span class="text-secondary">{{ $user->jabatan }}</span>
                </td>
                <td class="text-end py-2">
                    <a href="https://wa.me/{{ $user->no_hp }}" class="button btn btn-primary"><i
                            class="fa fa-whatsapp"></i>
                        Chat</a>
                </td>
            </tr>
            @empty
            Tidak ada kontak.
            @endforelse
        </tbody>
    </table>
</div>
