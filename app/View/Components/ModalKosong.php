<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalKosong extends Component
{
    public $idModal;
    public $icon;
    public $labelModal;
    public $ukuran;
    
    public function __construct($idModal, $icon, $labelModal, $ukuran='max-w-2xl')
    {
        //
        $this->idModal = $idModal;
        $this->icon =  $icon;
        $this->labelModal = $labelModal;
        $this->ukuran = $ukuran;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.modal-kosong');
    }
}
