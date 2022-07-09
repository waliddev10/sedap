<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use App\Models\UserPenugasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserPenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    public function show(UserPenugasan $penugasan)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'penugasan_id' => 'required',
            'jabatan_tim_id' => 'required',
            'user_id' => 'required'
        ]);

        $penugasan = UserPenugasan::where('penugasan_id', $request->penugasan_id);
        // cek apakah sudah ditunjuk dalam penugasan tsb?
        if ($penugasan->where('user_id', $request->user_id)->first()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User sudah ditambahkan dalam penugasan, harap menghapus data existing terlebih dahulu sebelum memasukkan data user baru dalam penugasan ini.',
            ], Response::HTTP_BAD_REQUEST);
        }

        UserPenugasan::create([
            'penugasan_id' => $request->penugasan_id,
            'jabatan_tim_id' => $request->jabatan_tim_id,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User Penugasan berhasil ditambah.',
        ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPenugasan $penugasan)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = UserPenugasan::findOrFail($id);
        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'UserPenugasan berhasil dihapus.'
        ], Response::HTTP_ACCEPTED);
    }
}
