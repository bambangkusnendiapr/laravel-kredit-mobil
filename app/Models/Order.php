<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $with = ['car', 'buyer'];

    protected $dates = ['tanggal'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

}
