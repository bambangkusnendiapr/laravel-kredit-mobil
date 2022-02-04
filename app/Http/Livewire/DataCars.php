<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use Livewire\WithPagination;

class DataCars extends Component
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
        return view('livewire.data-cars', [
            'cars' => Car::where('type', 'like', '%'.$this->search.'%')->paginate($this->paginate)
        ]);
    }

    public function addNew()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCar()
    {
        // dd((int)$this->state['nett'] + (int)$this->state['sales']);

        Validator::make($this->state, [
            'type' => 'required',
            'nett' => 'required',
            'sales' => 'required',
            'hadiah' => 'required',
            'ket' => 'required',
        ])->validate();

        $nett = str_replace(".","",$this->state['nett']);
        $sales = str_replace(".","",$this->state['sales']);

        $car = new Car;
        $car->type = $this->state['type'];
        $car->price_nett = (int)$nett;
        $car->price_sales = (int)$sales;
        $car->price_list = (int)$nett + (int)$sales;
        $car->hadiah = $this->state['hadiah'];
        $car->ket = $this->state['ket'];
        $car->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form');
    }

    public function delete($id)
    {
        $this->idHapus = $id;

        $this->dispatchBrowserEvent('show-form-delete');
    }

    public function deleteCar()
    {
        $car = Car::find($this->idHapus);

        $car->delete();

        $this->dispatchBrowserEvent('hide-form-delete');
    }

    public function edit($id)
    {
        $this->idEdit = $id;
        $car = Car::find($this->idEdit);
        $this->state['type'] = $car->type;
        $this->state['nett'] = $car->price_nett;
        $this->state['sales'] = $car->price_sales;
        // $this->state['list'] = $car->price_list;
        $this->state['hadiah'] = $car->hadiah;
        $this->state['ket'] = $car->ket;

        $this->dispatchBrowserEvent('show-form-edit');
    }

    public function updateCar()
    {
        Validator::make($this->state, [
            'type' => 'required',
            'nett' => 'required',
            'sales' => 'required',
            'hadiah' => 'required',
            'ket' => 'required',
        ])->validate();

        $nett = str_replace(".","",$this->state['nett']);
        $sales = str_replace(".","",$this->state['sales']);

        $car = Car::find($this->idEdit);
        $car->type = $this->state['type'];
        $car->price_nett = (int)$nett;
        $car->price_sales = (int)$sales;
        $car->price_list = (int)$nett + (int)$sales;
        $car->hadiah = $this->state['hadiah'];
        $car->ket = $this->state['ket'];
        $car->save();

        $this->resetInput();

        $this->dispatchBrowserEvent('hide-form-edit');
    }

    private function resetInput()
    {
        $this->state = null;
    }
}
