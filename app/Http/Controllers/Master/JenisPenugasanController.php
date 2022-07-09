<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\JenisPenugasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class JenisPenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(JenisPenugasan::all())
                ->addColumn('action', function ($item) {
                    return '<button class="btn btn-xs btn-primary" title="Ubah" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Ubah" href="' . route('jenis_penugasan.edit', $item->id) . '"><i class="fa fa-edit fa-fw"></i></button>
                    <button href="' . route('jenis_penugasan.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.data_master.jenis_penugasan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'pages.data_master.jenis_penugasan.create'
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
        ]);

        JenisPenugasan::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis Penugasan berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisPenugasan $jenis_penugasan)
    {
        return view('pages.data_master.jenis_penugasan.edit', [
            'item' => $jenis_penugasan,
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
        ]);

        $data = JenisPenugasan::findOrFail($id);
        $data->nama = $request->nama;
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis Penugasan berhasil diubah.',
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
        $data = JenisPenugasan::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Jenis Penugasan berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
