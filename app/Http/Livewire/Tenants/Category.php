<?php

namespace App\Http\Livewire\Tenants;

use Livewire\Component;
use App\Models\Tenant\Category as CategoryModel;

class Category extends Component
{
    public $isModalOpen = 0;
    public $name, $description, $category_id;

    public function render()
    {
        $categories = CategoryModel::all();
        return view('livewire.tenants.categories.index', compact('categories'));
    }

    public function create() {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function store() {
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
    
        CategoryModel::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'description' => $this->description
        ]);
        session()->flash('message', $this->category_id ? 'Category updated.' : 'Category created.');
        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id) {
        $category = CategoryModel::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->openModalPopover();
    }

    public function delete($id) {
        CategoryModel::find($id)->delete();
        session()->flash('message', 'Category deletead');
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->description = '';
    }
}
