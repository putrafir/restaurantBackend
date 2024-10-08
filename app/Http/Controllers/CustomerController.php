<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan dashboard customer
        return view('customer.index'); // Pastikan Anda sudah memiliki view 'customer/dashboard'
    }

    public function menu()
    {
        // Logika untuk menampilkan daftar menu
        return view('customer.menu'); // Pastikan Anda memiliki view 'customer/menu'
    }

    public function addToCart($menuId)
    {
        // Logika untuk menambahkan item ke keranjang
        return redirect()->back()->with('status', 'Item berhasil ditambahkan ke keranjang!');
    }

    public function checkout()
    {
        // Logika untuk proses checkout
        return view('customer.checkout'); // Pastikan Anda memiliki view 'customer/checkout'
    }
}
