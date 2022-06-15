<?php

namespace App\Http\Livewire\Component;
use App\Models\User;

use Livewire\Component;
use App\Models\Gudang;
use Illuminate\Http\Request;

class EditStock extends Component
{
    public $showSuccesNotification  = false;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.jumlah' => 'max:10',
        'user.satuan' => 'max:10',
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function edit($id_stock)
    {
        $row = Gudang::findOrFail($id_stock);
        return view('livewire.component.edit', compact('row'));
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
    public function render()
    {
        // $row = Gudang::findOrFail($kode_stock);
        // return view('livewire.component.edit', compact('row'));
        return view('livewire.component.edit');
    }
}
