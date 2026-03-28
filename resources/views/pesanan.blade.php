<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/pesanan.css')}}">
</head>
<body>
    <div id="dasb">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('hubungi1')}}" target="" class="hubungi">Contact</a>
        </div>
    </div>

    <div class="pesanan-container">
        @if($pesanan->isEmpty())
        <p>Belum ada pesanan</p>
        @else
        @foreach($pesanan as $item)
            <div class="pesanan-item">
                <img src="{{ asset('images/' . $item->produk->gambar_produk) }}">
                <div class="pesanan-detail">
                    <h3>{{ $item->produk->nama_produk }}</h3>
                    <p>ID Pesanan: {{ $item->id_pesanan }}</p>
                    <p>Deskripsi: {{ $item->produk->deskripsi_produk ?? '-' }}</p>
                    <p>Tanggal: {{ $item->tanggal }}</p>
                    <p>Total: Rp {{ $item->total_harga }}</p>
                    <p>Status: {{ $item->status_pesanan }}</p>
                </div>
            </div>
        @endforeach
        @endif
    </div>

    <footer>
        <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
    </footer>

</body>
</html>