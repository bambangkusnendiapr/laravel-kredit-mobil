<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Mobil extends Model
{
    use HasFactory;

    public function banks()
    {
        return $this->belongsToMany(Bank::class);
    }

    protected $appends = [
        'gambar_url',
    ];

    public function getGambarUrlAttribute()
    {
        if($this->gambar && Storage::disk('gambar')->exists($this->gambar)) {
            return Storage::disk('gambar')->url($this->gambar);
        }

        return asset('img/mobil.png');
    }
}
