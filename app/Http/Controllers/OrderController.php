<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Method untuk menampilkan riwayat pesanan pengguna
    public function index()
    {
        // Ambil pesanan yang terkait dengan user yang sedang login
        $orders = Order::where('user_id', auth()->id())->get();

        // Kirim data pesanan ke view
        return view('pages.pesananku', compact('orders'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan pemesanan.');
        }
        // Validasi input
        $request->validate([
            'product_id' => 'required|exists:products,id', // Pastikan produk ada
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'tanggal_ambil' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'status' => 'required|in:pending,berhasil,gagal',
        ]);

        // Ambil produk berdasarkan product_id
        $product = Product::findOrFail($request->product_id);

        // Periksa apakah stok tersedia
        if ($product->stok < 1) {
            return redirect()->route('user.dashboard')->with('error', 'Stok produk tidak mencukupi.');
        }

        // Kurangi stok produk
        $product->stok -= 1;
        $product->save();

        // Simpan pemesanan dengan user_id yang sedang login
        Order::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'tanggal_ambil' => $request->tanggal_ambil,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
            'user_id' => auth()->id(), // Menyertakan user_id yang sedang login
        ]);

        return redirect()->route('user.dashboard')->with('status', 'Pemesanan berhasil!');
    }

    public function adminIndex()
    {
        // Ambil hanya pesanan dengan status 'pending'
        $orders = Order::with('product')->where('status', 'pending')->get();

        // Kirim data pesanan ke view
        return view('pages.pesanan', compact('orders'));
    }


    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'berhasil';
        $order->save();

        return redirect()->route('admin.orders')->with('status', 'Pesanan diterima!');
    }

    public function rejectOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'gagal';
        $order->save();

        return redirect()->route('admin.orders')->with('status', 'Pesanan ditolak!');
    }

}
