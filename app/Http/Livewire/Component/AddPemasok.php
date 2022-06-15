<?php

namespace App\Http\Livewire\Component;
use App\Models\User;

use Livewire\Component;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class AddPemasok extends Component
{
    public $showSuccesNotification  = false;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.pemasok' => 'max:40|min:3',
        'user.stock' => 'max:10',
        'user.pabrik' => 'max:10',
    ];

    public function mount() { 
        $this->user = auth()->user();
    }

    public function masok(Request $request)
    {
        $request->validate([
        'id_pemasok' => 'bail|required|unique:pemasok',
        'nama_pemasok' => 'required'
        ],
        [
        'nama_Pabrik.required' => 'Nama Pabrik wajib diisi',
        'nama_stock.required' => 'Nama wajib diisi'
        ]);

        Pemasok::create([
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

    // public function edit($kode_stock)
    // {
    //     $row = Gudang::findOrFail($kode_stock);
    //     return view('livewire.component.add', compact('row'));
    // }
    public function destroy($id_pemasok)
    {
        $row = Pemasok::findOrFail($id_pemasok);
        $row->delete();
        return redirect('dashboard');
    }
    public function render()
    {
        return view('livewire.component.pemasok');
    }
}
