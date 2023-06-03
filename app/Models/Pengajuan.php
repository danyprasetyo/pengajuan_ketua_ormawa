<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id');
    }
}
