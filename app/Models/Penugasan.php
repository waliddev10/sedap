<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{

    protected $table = 'penugasan';

    protected $fillable = [
        'nama',
        'tgl_mulai',
        'tgl_selesai',
        'keterangan',
        'lokasi',
        'jenis_penugasan_id',
        'kategori_penugasan_id',
        'skpd_id',
        'bidang_id'
    ];

    public function jenis_penugasan()
    {
        return $this->belongsTo(JenisPenugasan::class);
    }

    public function kategori_penugasan()
    {
        return $this->belongsTo(KategoriPenugasan::class);
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function user_penugasan()
    {
        return $this->hasMany(UserPenugasan::class);
    }
}
