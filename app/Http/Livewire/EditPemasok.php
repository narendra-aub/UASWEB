<?php

namespace App\Http\Livewire;
use App\Models\User;

use Livewire\Component;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class EditPemasok extends Component
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

    public function edit($id_pemasok)
    {
        $row = Pemasok::findOrFail($id_pemasok);
        return view('livewire.editpemasok', compact('row'));
    }
    
    public function update(Request $request, $id_pemasok)
    {
        $request->validate([
            'nama_stock' => 'required'
        ],
        [
            'nama_stock.required' => 'Nama wajib diisi'
        ]);

        $row = Pemasok::findOrFail($id_pemasok);
        $row->update([
            'id_pemasok' => $request->id_pemasok,
            'nama_pemasok' => $request->nama_pemasok,
            'nama_stock' => $request->nama_stock,
            'nama_pabrik' => $request->nama_pabrik
            ]);

        return redirect('dashboard');
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
        return view('livewire.editpemasok');
    }
}
