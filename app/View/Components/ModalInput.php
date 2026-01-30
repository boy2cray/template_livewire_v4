<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalInput extends Component
{
    public $idModal;
    public $icon;
    public $labelModal;
    public $ukuran;
    public $clickEvent;
    public $buttonLabel;
    
    public function __construct($idModal, $icon, $labelModal, $ukuran='max-w-2xl', $clickEvent='', $buttonLabel='')
    {
        //
        $this->idModal = $idModal;
        $this->icon =  $icon;
        $this->labelModal = $labelModal;
        $this->ukuran = $ukuran;
        $this->clickEvent = $clickEvent;
        $this->buttonLabel = $buttonLabel;
    }

   
    public function render(): View|Closure|string
    {
        return view('components.modal-input');
    }
}
