<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Http\Livewire\Dashboard;

class GudangController extends Controller
{
    public function index()
    {
        $rows = Gudang::all();
        return view('livewire.Dashboard', compact('rows'));
    }

    public function create()
    {
        return view('gudang.add');
    }


    public function store(Request $request)
    {
        $request->validate([
        'kode_stock' => 'bail|required|unique:gudang',
        'nama_stock' => 'required'
        ],
        [
        'kode_stock.required' => 'NIM wajib diisi',
        'kode_stock.unique' => 'Nama Tahun sudah ada',
        'nama_stock.required' => 'Nama wajib diisi'
        ]);

        Gudang::create([
        'kode_stock' => $request->kode_stock,
        'nama_stock' => $request->nama_stock,
        'jumlah_stock' => $request->jumlah_stock,
        'satuan_stock' => $request->satuan_stock
        ]);

        return redirect('gudang');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $row = Gudang::findOrFail($id);
        return view('gudang.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'kode_stock' => 'bail|required|unique:gudang',
        'nama_stock' => 'required'
        ],
        [
        'kode_stock.required' => 'NIM wajib diisi',
        'kode_stock.unique' => 'Nama Tahun sudah ada',
        'nama_stock.required' => 'Nama wajib diisi'
        ]);

        $row = Gudang::findOrFail($id);
        $row->update([
        'kode_stock' => $request->kode_stock,
        'nama_stock' => $request->nama_stock,
        'jumlah_stock' => $request->jumlah_stock,
        'satuan_stock' => $request->satuan_stock
        ]);

        return redirect('gudang');
    }

    public function destroy($id)
    {
        $row = Gudang::findOrFail($id);
        $row->delete();
        return redirect('gudang');
    }
}