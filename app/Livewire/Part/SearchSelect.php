<?php

namespace App\Livewire\Part;
use Livewire\Attributes\Modelable;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class SearchSelect extends Component
{
    public $model;
    public $searchField;
    public $valueField;
    public $labelField;
    public $placeholder = 'Ketik untuk mencari...';
    public $kodeField = '';

    public $errorKey = null;

    #[Modelable]           // <-- penting: properti ini yang terikat wire:model ke parent
    public $selectedId;

    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $this->results = DB::table((new $this->model)->getTable())
            ->where($this->searchField, 'like', '%' . $this->search . '%')
            ->limit(10)
            ->get();
    }

    public function selectItem($id, $label)
    {
        $this->selectedId = $id; 
        $this->search = $label;
        $this->results = [];
    }

    public function clearSelection()
    {
        $this->selectedId = null;
        $this->search = '';
        $this->results = [];
    }

    public function render()
    {
        return view('livewire.part.search-select');
    }
}
