<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Bank;
use Livewire\WithPagination;

class DataBank extends Component
{
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

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        return view('livewire.data-bank', [
            'bank' => Bank::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createData()
    {
        // dd((int)$this->state['nett'] + (int)$this->state['sales']);

        Validator::make($this->state, [
            'nama' => 'required',
            'ket' => 'required',
        ])->validate();

        $bank = new Bank;
        $bank->nama = $this->state['nama'];
        $bank->ket = $this->state['ket'];
        $bank->save();

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
        $bank = Bank::find($this->idHapus);

        $bank->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $bank = Bank::find($this->idEdit);
        $this->state['nama'] = $bank->nama;
        $this->state['ket'] = $bank->ket;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateData()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'ket' => 'required',
        ])->validate();

        $bank = Bank::find($this->idEdit);
        $bank->nama = $this->state['nama'];
        $bank->ket = $this->state['ket'];
        $bank->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
