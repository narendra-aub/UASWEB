<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = "gudang";
    protected $primaryKey = "id_stock";
    protected $fillable =['nama_stock', 'jumlah_stock', 'satuan_stock', 'kode_stock'];
    use HasFactory;
}
