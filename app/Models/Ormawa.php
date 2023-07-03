<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    use HasFactory;

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'ormawa_id');
    }
}
