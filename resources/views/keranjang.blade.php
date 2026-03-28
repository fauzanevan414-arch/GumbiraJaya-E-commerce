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

    @foreach($keranjang as $item)
<div class="cart-item" id="item-{{ $item->id_keranjang }}">
    <img src="{{ asset('images/' . $item->produk->gambar_produk) }}" alt="">
    <div class="item-info">
        <h3>{{ $item->produk->nama_produk }}</h3>
        <p>Harga: Rp {{ $item->produk->harga_produk }}</p>
        <p>Jumlah: {{ $item->jumlah }}</p>
    </div>
    <div style="display:flex; flex-direction:column; align-items:flex-end; gap:8px;">
        <div class="item-total">Rp {{ $item->produk->harga_produk * $item->jumlah }}</div>
        <button class="btn-hapus" onclick="hapusItem({{ $item->id_keranjang }})">🗑 Hapus</button>
    </div>
</div>
@endforeach

<div class="cart-summary">
    <p>Grand Total</p>
    <span>Rp {{ $keranjang->sum(fn($i) => $i->produk->harga_produk * $i->jumlah) }}</span>
</div>

<button class="btn-beli" onclick="beliSemua()">Beli Sekarang</button>

<script>
function hapusItem(id) {
    if (!confirm('Hapus item ini?')) return;

    fetch('/keranjang/hapus', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ id_keranjang: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('item-' + id).remove();
            location.reload(); // reload biar grand total ikut update
        } else {
            alert(data.error || 'Gagal hapus!');
        }
    });
}

function beliSemua() {
    fetch('/keranjang/beli', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.open(data.wa_url, '_blank');
            window.location.reload();
        } else {
            alert(data.error || 'Gagal!');
        }
    });
}
</script>
    
</body>
</html>