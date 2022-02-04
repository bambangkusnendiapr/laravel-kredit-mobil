<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Credit;
use Livewire\WithPagination;

class DataCredits extends Component
{
    public $idOrder;

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
        $this->idOrder = $id;
        $this->search = request()->query('search', $this->search);
    }

    public function render()
    {
        // dd($this->idOrder);
        return view('livewire.data-credits', [
            'credits' => Credit::where('order_id', $this->idOrder)->paginate($this->paginate),
            'order' => Order::find($this->idOrder)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCredit()
    {
        // dd($this->idOrder);

        Validator::make($this->state, [
            'tanggal' => 'required',
            'nominal' => 'required',
            'ket' => 'required',
        ])->validate();

        $nominal = str_replace(".","",$this->state['nominal']);

        $credit = new Credit;
        $credit->tanggal = $this->state['tanggal'];
        $credit->order_id = $this->idOrder;
        $credit->nominal = (int)$nominal;
        $credit->ket = $this->state['ket'];
        $credit->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteCredit()
    {
        $credit = Credit::find($this->idHapus);

        $credit->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $credit = Credit::find($this->idEdit);
        $this->state['tanggal']  = $credit->tanggal->format('Y-m-d');
        $this->state['nominal']  = $credit->nominal;
        $this->state['ket']  = $credit->ket;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateCredit()
    {
        Validator::make($this->state, [
            'tanggal' => 'required',
            'nominal' => 'required',
            'ket' => 'required',
        ])->validate();

        $nominal = str_replace(".","",$this->state['nominal']);

        $credit = Credit::find($this->idEdit);
        $credit->tanggal = $this->state['tanggal'];
        $credit->order_id = $this->idOrder;
        $credit->nominal = (int)$nominal;
        $credit->ket = $this->state['ket'];
        $credit->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
