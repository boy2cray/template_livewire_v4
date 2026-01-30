<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalHapus extends Component
{
    public $idModal;
    public $labelModal;
    public $ukuran;
    public $clickEvent;
    public $buttonLabel;
    
    public function __construct($idModal, $labelModal, $ukuran='max-w-md', $clickEvent='', $buttonLabel='Hapus')
    {
        //
        $this->idModal = $idModal;
        $this->labelModal = $labelModal;
        $this->ukuran = $ukuran;
        $this->clickEvent = $clickEvent;
        $this->buttonLabel = $buttonLabel;
    }

    public function render(): View|Closure|string
    {
        return view('components.modal-hapus');
    }
}
