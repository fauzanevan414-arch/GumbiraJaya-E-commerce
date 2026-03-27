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
        <button class="btnbeli" onclick="openModal({{ $item->id_produk }}, '{{ $item->nama_produk }}', {{ $item->harga_produk }})">Beli</button>
        </div>
        @endforeach
    @endif
    </div>

    <div id="modal" class="modal">
        <div class="modal-content">
            <h3 id="namaProduk"></h3>
            <p id="hargaSatuan"></p>

            <div>
                <button onclick="kurang()">-</button>
                <span id="qty">1</span>
                <button onclick="tambah()">+</button>
            </div>

            <p>Total: <span id="totalHarga"></span></p>

            <button onclick="beliSekarang()">Beli</button>
            <button onclick="masukKeranjang()">Masukkan ke Keranjang</button>
            <button onclick="closeModal()">Tutup</button>
        </div>
    </div>


    <footer>
        <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
    </footer>

</body>

<script>
let produk = {};
let qty = 1;

function openModal(id, nama, harga){
    produk = {id, nama, harga};
    qty = 1;

    document.getElementById('modal').style.display = 'flex';
    document.getElementById('namaProduk').innerText = nama;
    document.getElementById('hargaSatuan').innerText = 'Rp ' + harga;

    updateTotal();
}

function closeModal(){
    document.getElementById('modal').style.display = 'none';
}

function tambah(){
    qty++;
    updateTotal();
}

function kurang(){
    if(qty > 1){
        qty--;
        updateTotal();
    }
}

function updateTotal(){
    document.getElementById('qty').innerText = qty;
    document.getElementById('totalHarga').innerText = 'Rp ' + (produk.harga * qty);
}

function beliSekarang(){
    let pesan = `Halo, saya ingin membeli:\n${produk.nama}\nJumlah: ${qty}\nSistem (diantar/ambil ke toko): ...\nTotal: Rp ${produk.harga * qty}\n\nAlamat: ...`;

    let url = `https://wa.me/628889592318?text=${encodeURIComponent(pesan)}`;

    // kirim ke database pesanan
    fetch('/pesanan/tambah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            produk_id: produk.id,
            qty: qty
        })
    });

    window.open(url, '_blank');
}

function masukKeranjang(){
    
    fetch('/keranjang/tambah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            produk_id: produk.id,
            qty: qty
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            alert('Masuk keranjang!');
            closeModal();
        } else {
            alert(data.error);
        }
    });
}
</script>

</html>