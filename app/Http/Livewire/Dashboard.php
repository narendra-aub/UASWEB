<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Gudang;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class Dashboard extends Component
{

    public $showSuccesNotification  = false;

    public $showDemoNotification = false;
    
    protected $rules = [
        'user.name' => 'max:40|min:3',
        'user.email' => 'email:rfc,dns',
        'user.phone' => 'max:10',
        'user.about' => 'max:200',
        'user.location' => 'min:3'
    ];

    public function render()
    {
        // return view('livewire.dashboard');
        $rows = Gudang::all();
        $masok = Pemasok::all();
        return view('livewire.Dashboard', compact('rows','masok'));
    }


    public function store(Request $request)
    {
        $request->validate([
        'id_stock' => 'bail|required|unique:gudang',
        'nama_stock' => 'required'
        ],
        [
        'kode_stock.required' => 'kode Stock wajib diisi',
        'nama_stock.required' => 'Nama wajib diisi'
        ]);

        Gudang::create([
        'id_stock' => $request->id_stock,
        'nama_stock' => $request->nama_stock,
        'jumlah_stock' => $request->jumlah_stock,
        'satuan_stock' => $request->satuan_stock,
        'kode_stock' => $request->kode_stock
        ]);

        return redirect('dashboard');
    }
    public function searchstock(Request $request)
    {
        $keyword = $request->search;

        $masok = Pemasok::all();
        $rows = Gudang::where('nama_stock', 'like', "%" . $keyword . "%")->paginate();
        return view('livewire.Dashboard', compact('rows', 'masok'));
    }
    
    public function update(Request $request, $id_stock)
    {
        $request->validate([
            'nama_stock' => 'required'
        ],
        [
            'nama_stock.required' => 'Nama wajib diisi'
        ]);

        $row = Gudang::findOrFail($id_stock);
        $row->update([
            'id_stock' => $request->id_stock,
            'nama_stock' => $request->nama_stock,
            'jumlah_stock' => $request->jumlah_stock,
            'satuan_stock' => $request->satuan_stock,
            'kode_stock' => $request->kode_stock
            ]);

        return redirect('dashboard');
    }

    public function destroy($id_stock)
    {
        $row = Gudang::findOrFail($id_stock);
        $row->delete();
        return redirect('dashboard');
    }
}
