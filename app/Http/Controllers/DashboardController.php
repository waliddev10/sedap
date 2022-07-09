<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arsip;
use App\Models\Bidang;
use App\Models\KategoriArsip;
use App\Models\Pangkat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kategori_arsip = KategoriArsip::all();
        $arsip = Arsip::with('user')
            ->orderBy('created_at', 'desc')
            ->when($request->search, function ($query) use ($request) {
                return $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('tgl_berkas', 'like', '%' . $request->search . '%')
                    ->orWhere('file', 'like', '%' . $request->search . '%');
            })
            ->get();
        return view('pages.dashboard.index', compact('kategori_arsip', 'arsip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $kategori_arsip_id)
    {
        return view(
            'pages.dashboard.show',
            [
                'kategori_arsip' => KategoriArsip::all(),
                'item' => KategoriArsip::findOrFail($kategori_arsip_id),
                'arsip' => Arsip::with('user')
                    ->where('kategori_arsip_id', $kategori_arsip_id)
                    ->when($request->search, function ($query) use ($request) {
                        return $query->where('nama', 'like', '%' . $request->search . '%')
                            ->orWhere('tgl_berkas', 'like', '%' . $request->search . '%')
                            ->orWhere('file', 'like', '%' . $request->search . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'pages.dashboard.create',
            [
                'kategori_arsip' => KategoriArsip::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'kategori_arsip_id' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
            'tgl_berkas' => 'required',
            'file' => 'required|file',
        ]);

        $time = time();

        $file = $request->file('file');

        $dir = storage_path('app/arsip/' . $request->kategori_arsip_id);
        $fileName = $time . '_' . $file->getClientOriginalName();
        $moveFile = $file->move($dir, $fileName);

        if ($moveFile) {
            Arsip::create([
                'user_id' => Auth::user()->id,
                'kategori_arsip_id' => $request->kategori_arsip_id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
                'tgl_berkas' => Carbon::parse($request->tgl_berkas)->format('Y-m-d'),
                'kode_unik' => $time,
                'file' => $file->getClientOriginalName(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Arsip berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.data_master.user.edit', [
            'item' => $user,
            'bidang' => Bidang::all(),
            'pangkat' => Pangkat::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string',
            'email' => 'required|email',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat_id' => 'required',
            'bidang_id' => 'required',
            'no_hp' => 'required',
            'password' => 'nullable',
            'role' => 'required|in:admin,user',
        ]);

        $data = User::findOrFail($id);
        $data->nama = $request->nama;
        $data->email = $request->email;
        $data->nip = $request->nip;
        $data->jabatan = $request->jabatan;
        $data->pangkat_id = $request->pangkat_id;
        $data->bidang_id = $request->bidang_id;
        $data->no_hp = $request->no_hp;
        $data->role = $request->role;
        if ($request->password) {
            $data->password = Hash::make($request->password);
        }
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil diubah.',
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }

    public function download($arsip_id)
    {
        $arsip = Arsip::findOrFail($arsip_id);

        $dir = storage_path('app/arsip/' . $arsip->kategori_arsip_id);

        $file = $dir . '/' . $arsip->kode_unik . '_' . $arsip->file;

        return response()->download($file, $arsip->file);
    }
}
