<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama_barang',
        'stok',
        'harga',
        'deskripsi',
        'gambar'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
