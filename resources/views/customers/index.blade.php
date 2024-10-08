@extends('customers.layouts.main')

@section('container')
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
            onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
    <h1>Pilih Menu</h1>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-4 gap-4">
            @foreach ($menus as $menu)
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <div class="card col" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body text-center">
                            <h4 class="card-title">{{ $menu->name }}</h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of
                                the
                                card's
                                content.</p>
                            <h5>{{ number_format($menu->price) }}</h5>
                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                            <input type="number" name="quantity" value="1" min="1">

                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form>
            @endforeach
        </div>
    </div>


    <a href="{{ route('cart.show') }}" class=" btn btn-primary" style="margin-top: 10rem;">{{ $totalQuantity }} item.
        Lihat
        Keranjang</a>
@endsection
