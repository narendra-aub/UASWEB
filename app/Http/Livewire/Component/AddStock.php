<?php

namespace App\Http\Livewire\Component;
use App\Models\User;

use Livewire\Component;
use App\Models\Gudang;

class AddStock extends Component
{
    public $showSuccesNotification  = false;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.jumlah' => 'max:10',
        'user.satuan' => 'max:10',
        'user.kode' => 'max:10',
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function save() {
        if(env('IS_DEMO')) {
           $this->showDemoNotification = true;
        } else {
            $this->validate();
            // $this->user->save();
            $this->showSuccesNotification = true;
        }
    }

    // public function edit($kode_stock)
    // {
    //     $row = Gudang::findOrFail($kode_stock);
    //     return view('livewire.component.add', compact('row'));
    // }

    public function render()
    {
        return view('livewire.component.add');
    }
}
