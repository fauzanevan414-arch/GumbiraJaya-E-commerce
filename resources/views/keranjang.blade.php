<h1>Keranjang Saya</h1>

@foreach($keranjang as $item)
    <div>
        <h3>{{ $item->produk->nama_produk }}</h3>
        <p>Jumlah: {{ $item->qty }}</p>
    </div>
@endforeach