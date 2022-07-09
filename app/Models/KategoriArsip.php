<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriArsip extends Model
{

    protected $table = 'kategori_arsip';

    protected $fillable = [
        'nama',
        'keterangan',
        'penugasan_id',
        'file'
    ];
}
