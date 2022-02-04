<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Beli;
use App\Models\Mobil;
use App\Models\Bank;
use App\Models\Buyer;
use App\Models\Harga;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataBeli extends Component
{
    public $state = [];
    public $tipe = null;
    public $lembaga = null;
    public $harga;
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
        if($this->tipe != null && $this->lembaga != null) {
            $this->harga = DB::table('bank_mobil')->where('bank_id', $this->lembaga)->where('mobil_id', $this->tipe)->get();
        }

        // DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();

        $beli = Beli::all();

        if(Auth::user()->hasRole('sales')) {
            $beli = Beli::where('sales', Auth::user()->id)->get();
        }

        return view('livewire.data-beli', [
            'beli' => $beli,
            'buyer' => Buyer::all(),
            'mobil' => Mobil::all(),
            'bank' => Bank::all(),
            'harga' => $this->harga,
            'sales' => User::whereRoleIs('sales')->get()
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createData()
    {
        // dd($this->harga[0]['id']);

        Validator::make($this->state, [
            'tanggal' => 'required',
            'pembeli' => 'required',
            'sales' => 'required',
            'ket' => 'required',
        ])->validate();

        $beli = new Beli;
        $beli->tanggal = $this->state['tanggal'];
        $beli->sales = $this->state['sales'];
        $beli->buyer_id = $this->state['pembeli'];
        $beli->harga_id = $this->harga[0]['id'];
        $beli->ket = $this->state['ket'];
        $beli->save();

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
        $beli = Beli::find($this->idHapus);

        $beli->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $beli = Beli::find($this->idEdit);
        $harga = Harga::find($beli->harga_id);

        $this->state['tanggal'] = $beli->tanggal->format('Y-m-d');
        $this->state['pembeli'] = $beli->buyer_id;
        $this->state['sales'] = $beli->sales;
        $this->state['ket'] = $beli->ket;

        $this->tipe = $harga->mobil_id;
        $this->lembaga = $harga->bank_id;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateData()
    {
        // dd($this->harga[0]['id']);
        // dd($this->state);
        Validator::make($this->state, [
            'tanggal' => 'required',
            'pembeli' => 'required',
            'sales' => 'required',
            'ket' => 'required',
        ])->validate();

        $beli = Beli::find($this->idEdit);
        $beli->tanggal = $this->state['tanggal'];
        $beli->sales = $this->state['sales'];
        $beli->buyer_id = $this->state['pembeli'];
        $beli->harga_id = $this->harga[0]['id'];
        $beli->ket = $this->state['ket'];
        $beli->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
        $this->harga = null;
        $this->tipe = null;
        $this->lembaga = null;
    }
}
