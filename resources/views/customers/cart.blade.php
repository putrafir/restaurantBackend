@extends('customers.layouts.main')

@section('container')
    @if (session('cart'))
        <table class="table table-light">
            <thead>
                <tr>
                    <th scope="col">Menu</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $details)
                    <tr>
                        <td>{{ $details['name'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $details['price'] }}</td>
                        <td>{{ number_format($details['price'] * $details['quantity']) }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Total Harga Keseluruhan: Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                </tr>

            </tbody>
        </table>
        <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit">Beli</button>
        </form>
    @else
        <p>Keranjang kosong</p>
    @endif

    <a href="{{ route('customer.menu') }}">Kembali ke Menu</a>
@endsection
