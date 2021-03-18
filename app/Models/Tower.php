<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat',
        'pemilik',
        'kecamatan',
        'latitude',
        'longitude',
        'status'
    ];

    public function kecamatans()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }

    public function pemiliks()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik');
    }
    
}
