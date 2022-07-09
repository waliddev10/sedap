<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\TanggalLibur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class TanggalLiburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(TanggalLibur::all())
                ->addColumn('action', function ($item) {
                    return '<button class="btn btn-xs btn-primary" title="Ubah" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Ubah" href="' . route('tanggal_libur.edit', $item->id) . '"><i class="fa fa-edit fa-fw"></i></button>
                    <button href="' . route('tanggal_libur.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.data_master.tanggal_libur.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'pages.data_master.tanggal_libur.create'
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
            'nama' => 'required|string',
            'tgl' => 'required|date',
        ]);

        TanggalLibur::create([
            'nama' => $request->nama,
            'tgl' => $request->tgl,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Tanggal Libur berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TanggalLibur $tanggal_libur)
    {
        return view('pages.data_master.tanggal_libur.edit', [
            'item' => $tanggal_libur,
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
            'tgl' => 'required|date',
        ]);

        $data = TanggalLibur::findOrFail($id);
        $data->nama = $request->nama;
        $data->tgl = $request->tgl;
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Tanggal Libur berhasil diubah.',
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
        $data = TanggalLibur::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Tanggal Libur berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
