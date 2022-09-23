<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use \App\Models\Tenant\Store as StoreModel;

class Store extends Component
{
    public ?StoreModel $store;

    protected $rules = [
        'store.name' => 'required|max:255',
        'store.description' => 'required|max:255',
        'store.phone' => 'required|max:20',
        'store.mobile_phone' => 'required|max:20',
    ];

    public function mount(StoreModel $store)
    {
        $this->store = $store->first() ?: $store;
    }
    public function saveStore()
    {
        $this->validate();
        $this->store->save();
        session()->flash('success', 'Loja salvo com Sucesso!');
    }

    public function render()
    {
        return view('livewire.tenants.store');
    }
}
