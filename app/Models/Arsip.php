<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{

    protected $table = 'arsip';

    protected $fillable = [
        'user_id',
        'kategori_arsip_id',
        'nama',
        'keterangan',
        'tgl_berkas',
        'kode_unik',
        'file',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
