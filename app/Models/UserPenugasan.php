<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPenugasan extends Model
{

    protected $table = 'user_penugasan';

    protected $fillable = [
        'penugasan_id',
        'user_id',
        'jabatan_tim_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan_tim()
    {
        return $this->belongsTo(JabatanTim::class);
    }

    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class);
    }
}
