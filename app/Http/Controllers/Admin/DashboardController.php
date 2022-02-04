<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mobil;
use App\Models\Buyer;
use App\Models\Beli;
use App\Models\Kredit;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('siswa')) {
            return redirect()->route('profile.student');
        }

        return view('admin.dashboard.index', [
            'mobil' => Mobil::all(),
            'buyer' => Buyer::all(),
            'beli' => Beli::all(),
            'kredit' => Kredit::all(),
        ]);
    }
}
