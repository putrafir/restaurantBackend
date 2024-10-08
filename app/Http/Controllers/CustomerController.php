<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {

        $menus = Menu::all();
        $cart = session()->get('cart', []);
        $totalQuantity = array_sum(array_column($cart, 'quantity'));

        // dd($totalQuantity);

        return view('customers.index', compact('menus', 'totalQuantity')); // Pastikan Anda sudah memiliki view 'customer/dashboard'
    }

    public function show()
    {
        $cart = session()->get('cart', []);

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        return view('customers.cart', compact('cart', 'totalPrice'));
    }

    public function add(Request $request)
    {
        // Ambil data menu berdasarkan ID yang dipilih
        $menu = Menu::find($request->menu_id);

        // Ambil item dari session atau buat array kosong jika tidak ada
        $cart = session()->get('cart', []);

        // Jika menu sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $request->quantity;
        } else {
            // Jika belum ada, tambahkan ke keranjang
            $cart[$menu->id] = [
                'name' => $menu->name,
                'quantity' => $request->quantity,
                'price' => $menu->price
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart,);

        return redirect()->route('customer.menu')->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $order = new Order();
        $order->queue_number = $this->generateQueueNumber(); // Fungsi untuk generate nomor antrian
        $order->total_price = $totalPrice;
        $order->status = 'pending'; // Status awal
        $order->order_date = now(); // Tanggal sekarang
        $order->save();


        foreach ($cart as $menuId => $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id; // Hubungkan dengan ID pesanan yang baru saja disimpan
            $orderItem->menu_id = $menuId; // Hubungkan dengan ID menu
            $orderItem->quantity = $item['quantity']; // Jumlah item
            $orderItem->price = $item['price']; // Harga item
            $orderItem->save(); // Simpan item ke database


            session()->forget('cart');

            return view('customers.checkout', compact('order'));
        }
    }


    public function generateQueueNumber()
    {
        // Ambil tanggal hari ini
        $today = date('Y-m-d');

        // Ambil nomor antrian terakhir yang telah digunakan hari ini
        $lastOrder = Order::whereDate('order_date', $today)
            ->orderBy('queue_number', 'desc')
            ->first();

        // Jika tidak ada order, mulai dari 1
        if (!$lastOrder) {
            return 1;
        }

        // Tambah 1 untuk nomor antrian berikutnya
        return $lastOrder->queue_number + 1;
    }
}
