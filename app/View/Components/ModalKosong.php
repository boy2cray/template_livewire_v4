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
    public $close_event;
    
    public function __construct($idModal, $icon, $labelModal, $ukuran='max-w-2xl', $closeEvent='resetImport')
    {
        //
        $this->idModal = $idModal;
        $this->icon =  $icon;
        $this->labelModal = $labelModal;
        $this->ukuran = $ukuran;
        $this->close_event = $closeEvent;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.modal-kosong');
    }
}
