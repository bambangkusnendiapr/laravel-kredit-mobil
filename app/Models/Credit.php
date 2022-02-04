<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $with = ['order'];

    protected $dates = ['tanggal'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
