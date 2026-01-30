<?php

namespace App\Traits;

use Livewire\WithPagination;

trait WithBaseTable
{
    //Paginasi Tailwind
    use WithPagination;
    protected string $paginationTheme = 'tailwind';

    //Variabel untuk jenis pencarian
    public string $search_type;

    //Variabel untuk keyword pencarian
    public string $search='';
    public ?string $start_date = null;
    public ?string $end_date = null;
    
    //Variabel untuk properti tabel
    public array $headers = [];
    public string $sortBy='id';
    public string $sortDir='asc';
    public int $perPage=10;

    //Status tombol aksi
    public bool $btnPrint=false;
    public bool $btnShow=false;
    public bool $btnEdit=true;
    public bool $btnDelete=true;

    //Fungsi untuk membuat pengurutan data pada tabel
    public function urutkan($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDir = 'asc';
        }
        $this->sortBy = $field;
    }

    //reset paginasi ketika search di update
    public function updatingSearch()
    {
        $this->resetPage();
    }
}