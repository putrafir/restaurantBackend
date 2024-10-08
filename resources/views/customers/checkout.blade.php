@extends('customers.layouts.main')


@section('container')
    <div class="container mt-5">
        <h1>Checkout</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h3>Nomor Antrian: {{ $order->queue_number }}</h3>
        <h4>Total Harga Keseluruhan: Rp {{ number_format($order->total_price, 2, ',', '.') }}</h4>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->menu->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('customer.menu') }}" class="btn btn-primary">Kembali ke Menu</a>
    </div>
@endsection
