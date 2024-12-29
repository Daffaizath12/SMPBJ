<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (Mass Assignment)
    protected $fillable = [
        'product_id',
        'name',
        'email',
        'phone',
        'address',
        'tanggal_ambil',
        'tanggal_kembali',
        'status',
        'user_id',
    ];

    // Menandai kolom yang harus diperlakukan sebagai objek Carbon
    protected $dates = ['tanggal_ambil', 'tanggal_kembali'];

    /**
     * Relasi antara Order dan Product
     * Setiap Order terkait dengan satu Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi dengan User (menggunakan user_id sebagai foreign key)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
