<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Pangkat;
use App\Models\User;
use App\Models\UserPenugasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RiwayatPenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $data = UserPenugasan::with(['penugasan', 'penugasan.skpd', 'jabatan_tim'])
                ->where('user_id', Auth::user()->id)
                ->get()
                ->when($request->has('order_by'), function ($collection) use ($request) {
                    if ($request->order_by == 'tgl_mulai') {
                        if ($request->sort == 'asc') {
                            return $collection->sortBy(function ($col, $key) {
                                return $col->penugasan->tgl_mulai;
                            });
                        } else {
                            return $collection->sortByDesc(function ($col, $key) {
                                return $col->penugasan->tgl_mulai;
                            });
                        }
                    }
                    if ($request->order_by == 'tgl_selesai') {
                        if ($request->sort == 'asc') {
                            return $collection->sortBy(function ($col, $key) {
                                return $col->penugasan->tgl_selesai;
                            });
                        } else {
                            return $collection->sortByDesc(function ($col, $key) {
                                return $col->penugasan->tgl_selesai;
                            });
                        }
                    }
                    if ($request->order_by == 'nama') {
                        if ($request->sort == 'asc') {
                            return $collection->sortBy(function ($col, $key) {
                                return $col->penugasan->nama;
                            });
                        } else {
                            return $collection->sortByDesc(function ($col, $key) {
                                return $col->penugasan->nama;
                            });
                        }
                    }
                });


            return view(
                'pages.riwayat_penugasan.list',
                [
                    'items' => $data
                ]
            );;
        }

        return view(
            'pages.riwayat_penugasan.index'
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
            'pages.data_master.user.create',
            [
                'bidang' => Bidang::all(),
                'pangkat' => Pangkat::all(),
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
            'nama' => 'required|string',
            'email' => 'required|email',
            'nip' => 'required|string',
            'jabatan' => 'required|string',
            'pangkat_id' => 'required',
            'bidang_id' => 'required',
            'no_hp' => 'required',
            'password' => 'required|string',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'pangkat_id' => $request->pangkat_id,
            'bidang_id' => $request->bidang_id,
            'no_hp' => $request->no_hp,
            'email_verified_at' => Carbon::now()->format('Y-m-d'),
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User berhasil ditambah.',
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
}
