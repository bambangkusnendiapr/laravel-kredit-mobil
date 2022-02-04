<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    use HasFactory;

    protected $with = ['buyer', 'harga'];

    protected $dates = ['tanggal'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function harga()
    {
        return $this->belongsTo(Harga::class, 'harga_id');
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'sales', 'id');
    }
}
