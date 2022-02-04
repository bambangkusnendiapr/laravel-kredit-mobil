<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use App\Models\Buyer;
use App\Models\Order;
use Livewire\WithPagination;

class DataOrders extends Component
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
        // $cari = 'tiga';
        // $cars = Car::where('type', 'like', '%'.$cari.'%')->get();
        // $id = [];
        // $a = 0;
        // foreach($cars as $car) {
        //     $id[$a] = $car->id;
        //     $a++;
        // }

        // // dd($id);
        // $buyer = Buyer::whereIn('id', $id)->get();
        // dd($buyer);

        // dd(1000/100*25);

        return view('livewire.data-orders', [
            'orders' => Order::paginate($this->paginate),
            'cars' => Car::all(),
            'buyers' => Buyer::all()
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createOrder()
    {
        // dd((int)$this->state['nett'] + (int)$this->state['sales']);

        Validator::make($this->state, [
            'tanggal' => 'required',
            'type' => 'required',
            'pembeli' => 'required',
            'kredit' => 'required',
            'ket' => 'required',
        ])->validate();

        $car = Car::find($this->state['type']);

        $order = new Order;
        $order->tanggal = $this->state['tanggal'];
        $order->car_id = $this->state['type'];
        $order->buyer_id = $this->state['pembeli'];
        $order->price = $car->price_list;
        $order->kredit = $this->state['kredit'];
        $order->ket = $this->state['ket'];
        $order->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteOrder()
    {
        $order = Order::find($this->idHapus);

        $order->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $order = Order::find($this->idEdit);
        $this->state['tanggal']  = $order->tanggal->format('Y-m-d');
        $this->state['type'] = $order->car_id;
        $this->state['pembeli'] = $order->buyer_id;
        $this->state['kredit'] = $order->kredit;
        $this->state['ket'] = $order->ket;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateOrder()
    {
        Validator::make($this->state, [
            'tanggal' => 'required',
            'type' => 'required',
            'pembeli' => 'required',
            'kredit' => 'required',
            'ket' => 'required',
        ])->validate();

        $car = Car::find($this->state['type']);

        $order = Order::find($this->idEdit);
        $order->tanggal = $this->state['tanggal'];
        $order->car_id = $this->state['type'];
        $order->buyer_id = $this->state['pembeli'];
        $order->price = $car->price_list;
        $order->kredit = $this->state['kredit'];
        $order->ket = $this->state['ket'];
        $order->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
