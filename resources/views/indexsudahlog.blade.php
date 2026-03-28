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
            <a href="{{ route('pesanan') }}" class="pesanan">Pesanan</a>
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
        <button onclick="openModal('{{ $item->id_produk }}', '{{ $item->nama_produk }}', '{{ $item->harga_produk }}')">Beli</button>
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
let jumlah = 1;

function openModal(id, nama, harga){
    produk = {
        id: parseInt(id),
        nama: nama,
        harga: parseInt(harga)
    };
    jumlah = 1;

        console.log(produk);
        console.log(jumlah);

    document.getElementById('modal').style.display = 'flex';
    document.getElementById('namaProduk').innerText = nama;
    document.getElementById('hargaSatuan').innerText = 'Rp ' + harga;

    updateTotal();
}

function closeModal(){
    document.getElementById('modal').style.display = 'none';
}

function tambah(){
    jumlah++;
    updateTotal();
}

function kurang(){
    if(jumlah > 1){
        jumlah--;
        updateTotal();
    }
}

function updateTotal(){
    document.getElementById('qty').innerText = jumlah;
    document.getElementById('totalHarga').innerText = 'Rp ' + (produk.harga * jumlah);
}

function beliSekarang(){
    let total = produk.harga * jumlah;

    let pesan = `Halo, saya ingin membeli:
${produk.nama}
Jumlah: ${jumlah}
Total: Rp ${total}
Sistem (diantar/ambil ke toko): ...

Alamat: ...`;

    fetch('/pesanan/tambah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            produk_id: produk.id,
            jumlah: jumlah,
            total_harga: total
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success){
            let url = `https://wa.me/628889592318?text=${encodeURIComponent(pesan)}`;
            window.open(url, '_blank');
        } else {
            alert(data.error || 'Gagal menyimpan pesanan');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi error');
    });
}

function masukKeranjang(){
    fetch('/keranjang/tambah', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            produk_id: produk.id,
            jumlah: jumlah
        })
    })
    .then(res => {
        console.log('Status:', res.status); // Lihat status HTTP-nya
        return res.text(); // Pakai .text() dulu, bukan .json()
    })
    .then(text => {
        console.log('Raw response:', text); // Lihat isi response-nya
        try {
            const data = JSON.parse(text);
            if(data.success){
                alert('Masuk keranjang!');
                closeModal();
            } else {
                alert(data.error || 'Gagal!');
            }
        } catch(e) {
            alert('Server tidak mengembalikan JSON: ' + text.substring(0, 100));
        }
    })
    .catch(err => {
        console.error(err);
        alert('Terjadi error!');
    });
}
</script>

</html>