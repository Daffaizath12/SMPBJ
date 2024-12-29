<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Fungsi untuk menampilkan data barang
    public function index()
    {
        $products = Product::all();
        return view('pages.barang', compact('products'));
        
    }

    // Fungsi untuk menampilkan form tambah barang
    public function create()
    {
        return view('pages.product.create');
    }

    // Fungsi untuk menyimpan barang
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ]);

        // Generate kode barang otomatis
        $kode = 'B' . Str::upper(Str::random(4)); // Generate kode barang BXXXX

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('products');
        } else {
            $gambar = null;
        }

        // Simpan data barang
        Product::create([
            'kode' => $kode,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Fungsi untuk menampilkan form edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.barang.edit', compact('product'));
    }

    // Fungsi untuk memperbarui data barang
        public function update(Request $request, $id)
        {
            // Temukan produk yang akan diperbarui
            $product = Product::findOrFail($id);

            // Update data produk yang lain
            $product->kode = $request->input('kode');
            $product->nama_barang = $request->input('nama');
            $product->stok = $request->input('stok');
            $product->harga = $request->input('harga');
            $product->deskripsi = $request->input('deskripsi');

            // Periksa apakah ada gambar baru yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($product->gambar) {
                    Storage::disk('public')->delete($product->gambar);
                }

                // Simpan gambar baru
                $imagePath = $request->file('gambar')->store('products', 'public');
                $product->gambar = basename($imagePath); // Simpan nama gambar di database
            }

            // Simpan perubahan produk
            $product->save();

            return redirect()->route('products.index')->with('status', 'Barang berhasil diupdate!');
        }


    // Fungsi untuk menghapus barang
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus gambar barang jika ada
        if ($product->gambar) {
            Storage::delete($product->gambar);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus');
    }
}
