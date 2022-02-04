<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use App\Models\Bank;
use App\Models\Mobil;
use Illuminate\Support\Facades\DB;

class DataHarga extends Component
{
    public $idBank;

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
        $this->idBank = $id;
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.data-harga', [
            'harga' => DB::table('bank_mobil')->where('bank_id', $this->idBank)->paginate($this->paginate),
            'bank' => Bank::find($this->idBank),
            'mobil' => Mobil::all()
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createData()
    {
        // dd($this->state);

        Validator::make($this->state, [
            'tenor' => 'required',
            'mobil' => 'required',
            'harga' => 'required',
            'bunga' => 'required',
            'dp' => 'required',
            'tdp' => 'required',
            'angsuran' => 'required',
        ])->validate();

        $harga = str_replace(".","",$this->state['harga']);
        $tdp = str_replace(".","",$this->state['tdp']);
        $angsuran = str_replace(".","",$this->state['angsuran']);

        DB::table('bank_mobil')->insert([
            'bank_id' => $this->idBank,
            'mobil_id' => $this->state['mobil'],
            'harga' => $harga,
            'tenor' => $this->state['tenor'],
            'bunga_persen' => $this->state['bunga'],
            'dp_persen' => $this->state['dp'],
            'dp_nominal' => $tdp,
            'angsuran' => $angsuran,
            'hadiah' => '-',
            'ket' => '-',
        ]);

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
        $harga = DB::table('bank_mobil')->delete($this->idHapus);

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $harga = DB::table('bank_mobil')->where('id', $this->idEdit)->first();
        $this->state['mobil']  = $harga->mobil_id;
        $this->state['harga']  = $harga->harga;
        $this->state['tenor']  = $harga->tenor;
        $this->state['bunga']  = $harga->bunga_persen;
        $this->state['dp']  = $harga->dp_persen;
        $this->state['tdp']  = $harga->dp_nominal;
        $this->state['angsuran']  = $harga->angsuran;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateData()
    {
        Validator::make($this->state, [
            'tenor' => 'required',
            'mobil' => 'required',
            'harga' => 'required',
            'bunga' => 'required',
            'dp' => 'required',
            'tdp' => 'required',
            'angsuran' => 'required',
        ])->validate();

        $harga = str_replace(".","",$this->state['harga']);
        $tdp = str_replace(".","",$this->state['tdp']);
        $angsuran = str_replace(".","",$this->state['angsuran']);

        DB::table('bank_mobil')->where('id', $this->idEdit)->update([
            'bank_id' => $this->idBank,
            'mobil_id' => $this->state['mobil'],
            'harga' => $harga,
            'tenor' => $this->state['tenor'],
            'bunga_persen' => $this->state['bunga'],
            'dp_persen' => $this->state['dp'],
            'dp_nominal' => $tdp,
            'angsuran' => $angsuran,
        ]);

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
