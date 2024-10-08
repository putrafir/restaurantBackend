<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// #[CheckRole('kasir')]
class CashierController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard kasir
        return view('cashier.dashboard'); // Pastikan Anda sudah memiliki view 'kasir/dashboard'
    }

    public function confirmOrder($orderId)
    {
        // Logika untuk mengkonfirmasi pesanan
        return redirect()->back()->with('status', 'Pesanan berhasil dikonfirmasi!');
    }

    public function orderHistory()
    {
        // Logika untuk menampilkan riwayat pemesanan
        return view('kasir.order_history'); // Pastikan Anda memiliki view 'kasir/order_history'
    }
}
