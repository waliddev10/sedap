<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\JabatanTim;
use App\Models\JenisPenugasan;
use App\Models\KategoriPenugasan;
use App\Models\Penugasan;
use App\Models\Skpd;
use App\Models\User;
use App\Models\UserPenugasan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class PenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $data = Penugasan::with(['jenis_penugasan', 'kategori_penugasan', 'skpd', 'bidang'])
                ->withCount(['user_penugasan'])
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($item) {
                    return '<button type="button" class="btn btn-xs btn-primary" title="Lihat Komponen Tim" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Lihat Komponen Tim" href="' . route('penugasan.show', $item->id) . '"><i class="fa fa-users"></i></button>
                    <button type="button" class="btn btn-xs btn-warning" title="Ubah" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Ubah" href="' . route('penugasan.edit', $item->id) . '"><i class="fa fa-edit"></i></button>
                    <button type="button" href="' . route('penugasan.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.penugasan.index');
    }

    public function show(Penugasan $penugasan, Request $request)
    {
        if ($request->wantsJson()) {
            $data = UserPenugasan::with(['user', 'jabatan_tim'])
                ->where('penugasan_id', $penugasan->id)
                ->get();

            return DataTables::of($data)
                ->addColumn('action', function ($item) {
                    return '<button href="' . route('user_penugasan.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen" data-target-table-child="tableDokumenChild"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view(
            'pages.penugasan.show',
            [
                'item' => $penugasan,
                'bidang' => Bidang::all(),
                'user' => User::all(),
                'jabatan_tim' => JabatanTim::all()
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
            'pages.penugasan.create',
            [
                'jenis_penugasan' => JenisPenugasan::all(),
                'kategori_penugasan' => KategoriPenugasan::all(),
                'skpd' => Skpd::all(),
                'bidang' => Bidang::all(),
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
            'nama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'lokasi' => 'required',
            'jenis_penugasan_id' => 'required',
            'kategori_penugasan_id' => 'required',
            'skpd_id' => 'required',
            'bidang_id' => 'required'
        ]);

        Penugasan::create([
            'nama' => $request->nama,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'jenis_penugasan_id' => $request->jenis_penugasan_id,
            'kategori_penugasan_id' => $request->kategori_penugasan_id,
            'skpd_id' => $request->skpd_id,
            'bidang_id' => $request->bidang_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Penugasan berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Penugasan $penugasan)
    {
        return view('pages.penugasan.edit', [
            'item' => $penugasan,
            'jenis_penugasan' => JenisPenugasan::all(),
            'kategori_penugasan' => KategoriPenugasan::all(),
            'skpd' => Skpd::all(),
            'bidang' => Bidang::all(),
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
            'nama' => 'required',
            'tgl_mulai' => 'required',
            'tgl_selesai' => 'required',
            'keterangan' => 'required',
            'lokasi' => 'required',
            'jenis_penugasan_id' => 'required',
            'kategori_penugasan_id' => 'required',
            'skpd_id' => 'required',
            'bidang_id' => 'required'
        ]);

        $data = Penugasan::findOrFail($id);
        $data->nama = $request->nama;
        $data->tgl_mulai = $request->tgl_mulai;
        $data->tgl_selesai = $request->tgl_selesai;
        $data->keterangan = $request->keterangan;
        $data->lokasi = $request->lokasi;
        $data->jenis_penugasan_id = $request->jenis_penugasan_id;
        $data->kategori_penugasan_id = $request->kategori_penugasan_id;
        $data->skpd_id = $request->skpd_id;
        $data->bidang_id = $request->bidang_id;
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Penugasan berhasil diubah.',
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
        $data = Penugasan::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Penugasan berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
