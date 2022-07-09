<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Skpd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class SkpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return DataTables::of(Skpd::all())
                ->addColumn('action', function ($item) {
                    return '<button class="btn btn-xs btn-primary" title="Ubah" data-bs-toggle="modal" data-bs-target="#modalContainer" data-title="Ubah" href="' . route('skpd.edit', $item->id) . '"><i class="fa fa-edit fa-fw"></i></button>
                    <button href="' . route('skpd.destroy', $item->id) . '" class="btn btn-xs btn-danger delete" data-target-table="tableDokumen"><i class="fa fa-trash"></i></button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('pages.data_master.skpd.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(
            'pages.data_master.skpd.create'
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

        Skpd::create([
            'nama' => $request->nama,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Skpd berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Skpd $skpd)
    {
        return view('pages.data_master.skpd.edit', [
            'item' => $skpd,
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

        $data = Skpd::findOrFail($id);
        $data->nama = $request->nama;
        $data->update();

        return response()->json([
            'status' => 'success',
            'message' => 'Skpd berhasil diubah.',
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
        $data = Skpd::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Skpd berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
