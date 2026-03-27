<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/keranjang.css')}}">
</head>
<body>
    <div id="dasb">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('hubungi1')}}" target="" class="hubungi">Contact</a>
            <h2>MY Cart</h2>
        </div>

        @foreach($keranjang as $item)
    <div>
        <h3>{{ $item->produk->nama_produk }}</h3>
        <p>Harga: Rp {{ $item->produk->harga_produk }}</p>
        <p>Jumlah: {{ $item->qty }}</p>
        <p>Total: Rp {{ $item->produk->harga_produk * $item->qty }}</p>
    </div>
@endforeach
    
</body>
</html>