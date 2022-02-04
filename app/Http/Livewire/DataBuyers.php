<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Buyer;
use Livewire\WithPagination;

class DataBuyers extends Component
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
        return view('livewire.data-buyers', [
            'buyers' => Buyer::where('nama', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createBuyer()
    {
        // dd((int)$this->state['nett'] + (int)$this->state['sales']);

        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'ket' => 'required',
        ])->validate();

        $buyer = new Buyer;
        $buyer->nama = $this->state['nama'];
        $buyer->jk = $this->state['jk'];
        $buyer->hp = $this->state['hp'];
        $buyer->alamat = $this->state['alamat'];
        $buyer->ket = $this->state['ket'];
        $buyer->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteBuyer()
    {
        $buyer = Buyer::find($this->idHapus);

        $buyer->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $buyer = Buyer::find($this->idEdit);
        $this->state = $buyer->toArray();

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateBuyer()
    {
        Validator::make($this->state, [
            'nama' => 'required',
            'jk' => 'required',
            'hp' => 'required',
            'alamat' => 'required',
            'ket' => 'required',
        ])->validate();

        $buyer = Buyer::find($this->idEdit);
        $buyer->nama = $this->state['nama'];
        $buyer->jk = $this->state['jk'];
        $buyer->hp = $this->state['hp'];
        $buyer->alamat = $this->state['alamat'];
        $buyer->ket = $this->state['ket'];
        $buyer->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
