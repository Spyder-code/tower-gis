<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'uang',
        'tahun',
        'tower_id'
    ];

    public function tower()
    {
        return $this->belongsTo(Tower::class,'tower_id');
    }
}
