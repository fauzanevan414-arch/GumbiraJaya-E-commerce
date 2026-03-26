<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gumbira Jaya</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/style1.css')}}">
</head>

<body>
    <div id="db">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('kategoritoko')}}" target="" class="kategori">Category</a>
            <a href="{{route('hubungi1')}}" target="" class="hubungi">Contact</a>
            
            <div class="action">
                <div class="search">
                    <form action="{{route('indexsudahlog')}}" method="get">
                        <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}">
                        <button><img src="{{asset('images/search_3856329.png')}}" width="15" height="15"></button>
                    </form>
                </div>
            </div>
            <a href="{{route('keranjang')}}"><img class="keranjang" src="{{asset('images/shopping-cart_1055226.png')}}" alt="foto" width="50" height="50"></a>
            <a href="" class="pesanan">Pesanan</a>
            <a class="profile" href="{{route('profile')}}"><img src="{{asset('images/profile.png')}}" width="55" height="55"></a>
        </div>
    </div>

    <div class="ltr">
    @if($produk->isEmpty())
    <div class="kosong">
    <h2>Item not found</h2>
    </div>
    @else
        @foreach ($produk as $item)
        <div class="itembarang">
            <img src="{{asset('images/'.$item->gambar_produk)}}" alt="foto" width="275" height="200"  class="gambar-produk">
        <h3>{{$item->nama_produk}}</h3>
        <p class="stok">({{'Stok: '.$item->stok_produk}})</p>
        <p class="harga">{{'Rp. '.$item->harga_produk}}</p>
        <button class="btnbeli"
        onclick="openModal('{{ $item->nama_produk }}', {{ $item->harga_produk }})">Beli</button>
        </div>
        @endforeach
    @endif
    </div>

    <div id="modal" class="modal">
    <div class="modal-content">
        <h3 id="namaProduk"></h3>
        <p id="hargaProduk"></p>

        <button onclick="beliSekarang()">Beli Sekarang</button>
        <button onclick="tambahKeranjang()">Tambah ke Keranjang</button>

        <br><br>
        <button onclick="closeModal()">Tutup</button>
    </div>
</div>

<script>
let produkDipilih = {};

function openModal(nama, harga) {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('namaProduk').innerText = nama;
    document.getElementById('hargaProduk').innerText = 'Rp ' + harga;

    produkDipilih = { nama, harga };
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

function beliSekarang() {
    let pesan = `Halo, saya ingin membeli:\n${produkDipilih.nama}\nHarga: Rp ${produkDipilih.harga}\n\nAlamat saya: ...`;

    let url = `https://wa.me/628xxxxxxxxxx?text=${encodeURIComponent(pesan)}`;
    window.open(url, '_blank');
}

function tambahKeranjang() {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

    keranjang.push({
        nama: produkDipilih.nama,
        harga: produkDipilih.harga,
        qty: 1
    });

    localStorage.setItem('keranjang', JSON.stringify(keranjang));

    alert('Ditambahkan ke keranjang!');
    closeModal();
}
</script>
    <footer>
        <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
    </footer>

</body>

</html>