<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Harga extends Model
{
    use HasFactory;

    protected $table = 'bank_mobil';

    protected $with = ['bank', 'mobil'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}