<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mobil;
use File;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.mobil.index', [
            'mobil' => Mobil::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tipe' => ['required'],
            'filefoto' => 'mimes:jpeg,jpg,png,gif|max:2000' // max 2000kb/2mb
        ],
        [
            'tipe.required' => 'Tipe Mobil Harus diisi',
            'filefoto.mimes' => 'harus diisi file gambar',
            'filefoto.max' => 'maksimal 2 MB'
        ]);

        $mobil = new Mobil;
        $mobil->tipe     = $request->tipe;
        $mobil->ket     = $request->ket;

        if($request->hasFile('filefoto') == true){
            $file2 = $request->file('filefoto');
            $namafile2 = time()."".$file2->getClientOriginalName();
    
            $tujuan_upload = 'gambar/';
            $file2->move($tujuan_upload,$namafile2);
            $mobil->gambar = $namafile2;
        }

        $mobil->save();

        return redirect()->route('mobils.index')->with(['success' => 'Data mobil berhasil ditambahkan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.mobil.edit', [
            'mobil' => Mobil::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tipe' => ['required'],
            'filefoto' => 'mimes:jpeg,jpg,png,gif|max:2000' // max 2000kb/2mb
        ],
        [
            'tipe.required' => 'Tipe Mobil Harus diisi',
            'filefoto.mimes' => 'harus diisi file gambar',
            'filefoto.max' => 'maksimal 2 MB'
        ]);

        $mobil = Mobil::find($id);
        $mobil->tipe     = $request->tipe;
        $mobil->ket     = $request->ket;

        if($request->hasFile('filefoto') == true){
            $file2 = $request->file('filefoto');
            $namafile2 = time()."".$file2->getClientOriginalName();

            $file_ext  = $file->getClientOriginalExtension();
            
            $local_gambar = "gambar/".$mobil->gambar;
            if(File::exists($local_gambar))
            {
                File::delete($local_gambar);
            }
    
            $tujuan_upload = 'gambar/';
            $file2->move($tujuan_upload,$namafile2);
            $mobil->gambar = $namafile2;
        }

        $mobil->save();

        return redirect()->route('mobils.index')->with(['success' => 'Data mobil berhasil diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mobil = Mobil::find($id);
        if($mobil->gambar) {
            $local_gambar = "gambar/".$mobil->gambar;
            if(File::exists($local_gambar))
            {
                File::delete($local_gambar);
            }
        }
        $mobil->delete();
        return redirect()->route('mobils.index')->with(['success' => 'Data mobil berhasil dihapus']);
    }
}
