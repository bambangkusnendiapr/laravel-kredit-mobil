<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Bank;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index()
    {
        return view('depan', [
            'mobil' => Mobil::inRandomOrder()->limit(4)->get()
        ]);
    }

    public function mobil()
    {
        return view('depan-mobil', [
            'mobil' => Mobil::all()
        ]);
    }

    public function mobil_detail($id)
    {        
        return view('depan-mobil-detail', [
            'mobil' => Mobil::find($id),
            'bank' => Bank::all(),
            'harga' => DB::table('bank_mobil')->where('mobil_id', $id)->get(),
        ]);
    }
}
