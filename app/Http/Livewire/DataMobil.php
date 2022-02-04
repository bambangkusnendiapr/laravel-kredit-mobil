<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Mobil;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use File;
use Illuminate\Support\Facades\Storage;

class DataMobil extends Component
{
    use WithFileUploads;

    public $state = [];
    public $idHapus = null;
    public $idEdit = null;
    public $edit = false;

    public $photo;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 10;
    public $foo;
    public $search = '';
    public $page = 1;

    protected $queryString = [
        'foo',
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.data-mobil', [
            'mobil' => Mobil::where('tipe', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->reset();

        $this->dispatchBrowserEvent('show-form');
    }

    public function createData()
    {
        // dd($this->photo->getClientOriginalName());
        // dd($this->photo);
        

        Validator::make($this->state, [
            'tipe' => 'required',
            'ket' => 'required',
        ])->validate();

        $mobil = new Mobil;

        if($this->photo) {
            $this->validate([
                'photo' => 'image|max:2048', // 2MB Max
            ]);
            
            // $img = $this->photo->getFilename();
            $namafile2 = time()."".$this->photo->getClientOriginalName();
            // $path = public_path('\gambar');
            $this->photo->storePubliclyAs('/', $namafile2, 'gambar');
            // $img->move($path, $namafile2);
            $mobil->gambar = $namafile2;
        }

        $mobil->tipe = $this->state['tipe'];
        $mobil->ket = $this->state['ket'];
        $mobil->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteData()
    {
        $mobil = Mobil::find($this->idHapus);

        Storage::disk('gambar')->delete($mobil->gambar);

        $mobil->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->reset();

        $this->idEdit = $id;
        $mobil = Mobil::find($this->idEdit);
        $this->state['tipe'] = $mobil->tipe;
        $this->state['ket'] = $mobil->ket;

        $this->edit = true;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateData()
    {
        Validator::make($this->state, [
            'tipe' => 'required',
            'ket' => 'required',
        ])->validate();

        $mobil = Mobil::find($this->idEdit);

        if($this->photo) {
            $this->validate([
                'photo' => 'image|max:2048', // 2MB Max
            ]);
            
            Storage::disk('gambar')->delete($mobil->gambar);

            $namafile2 = time()."".$this->photo->getClientOriginalName();
            $this->photo->storePubliclyAs('/', $namafile2, 'gambar');
            $mobil->gambar = $namafile2;
        }

        $mobil->tipe = $this->state['tipe'];
        $mobil->ket = $this->state['ket'];
        $mobil->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
