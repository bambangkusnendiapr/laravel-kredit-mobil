<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Beli;
use App\Models\Kredit;
use App\Models\Harga;
use Livewire\WithPagination;

class DataKredit extends Component
{
    public $idBeli;

    public $state = [];
    public $idHapus = null;
    public $idEdit = null;

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

    public function mount($id)
    {
        $this->idBeli = $id;
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        //Data Beli
        $beli = Beli::find($this->idBeli);

        //Data Kredit
        $kredit = Kredit::where('beli_id', $this->idBeli)->paginate($this->paginate);

        //Data Harga
        $harga = Harga::find($beli->harga_id);

        return view('livewire.data-kredit', [
            'beli' => $beli,
            'kredit' => $kredit,
            'harga' => $harga
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createData()
    {
        // dd($this->idOrder);

        Validator::make($this->state, [
            'tanggal' => 'required',
            'nominal' => 'required',
            'ket' => 'required',
        ])->validate();

        $nominal = str_replace(".","",$this->state['nominal']);

        $kredit = new Kredit;
        $kredit->tanggal = $this->state['tanggal'];
        $kredit->beli_id = $this->idBeli;
        $kredit->nominal = (int)$nominal;
        $kredit->ket = $this->state['ket'];
        $kredit->save();

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
        $kredit = Kredit::find($this->idHapus);

        $kredit->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $kredit = Kredit::find($this->idEdit);
        $this->state['tanggal']  = $kredit->tanggal->format('Y-m-d');
        $this->state['nominal']  = $kredit->nominal;
        $this->state['ket']  = $kredit->ket;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateData()
    {
        Validator::make($this->state, [
            'tanggal' => 'required',
            'nominal' => 'required',
            'ket' => 'required',
        ])->validate();

        $nominal = str_replace(".","",$this->state['nominal']);

        $kredit = Kredit::find($this->idEdit);
        $kredit->tanggal = $this->state['tanggal'];
        $kredit->beli_id = $this->idBeli;
        $kredit->nominal = (int)$nominal;
        $kredit->ket = $this->state['ket'];
        $kredit->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
