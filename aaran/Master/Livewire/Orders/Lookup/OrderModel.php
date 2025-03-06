<?php

namespace Aaran\Master\Livewire\Orders\Lookup;

use Aaran\Master\Models\Order;
use Livewire\Component;

class OrderModel extends Component
{
    public bool $showModel = false;

    public $vname ='';
    public $order_name='';

    public function mount($name): void
    {
        $this->vname = $name;
    }

    public function save(): void
    {
        if ($this->vname != '') {
            $obj = Order::create([
                'vname' => ($this->vname),
                'order_name'=>$this->order_name,
                'company_id' => session()->get('company_id'),
                'active_id' => '1'
            ]);
            $this->dispatch('refresh-order', ['name' => $this->vname,'order_name'=>$this->order_name, 'id' => $obj->id]);
            $this->clearAll();
        }
    }

    public function clearAll(): void
    {
        $this->showModel = false;
        $this->vname = '';
        $this->order_name='';
    }
    public function render()
    {
        return view('master::Orders.Lookup.order-model');
    }
}
