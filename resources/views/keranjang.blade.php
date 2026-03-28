<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/keranjang.css')}}">
    <link rel="stylesheet" href="{{asset('css/keranjang2.css')}}">
</head>
<body>
    <div id="dasb">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('hubungi1')}}" target="" class="hubungi">Contact</a>
        </div>

<div class="page-wrapper">
    <h1>My Cart</h1>

    @if($keranjang->isEmpty())
        <div class="kosong">
            <h2>Keranjang masih kosong</h2>
        </div>
    @else
        @foreach($keranjang as $item)
        <div class="cart-item">
            <img src="{{ asset('images/' . $item->produk->gambar_produk) }}" alt="">
            <div class="item-info">
                <h3>{{ $item->produk->nama_produk }}</h3>
                <p>Harga: Rp {{ $item->produk->harga_produk }}</p>
                <p>Jumlah: {{ $item->jumlah }}</p>
            </div>
            <div class="item-total">
                Rp {{ $item->produk->harga_produk * $item->jumlah }}
            </div>
        </div>
        @endforeach

        <div class="cart-summary">
            <p>Grand Total</p>
            <span>Rp {{ $keranjang->sum(fn($i) => $i->produk->harga_produk * $i->jumlah) }}</span>
        </div>
    @endif
</div>
    
</body>
</html>