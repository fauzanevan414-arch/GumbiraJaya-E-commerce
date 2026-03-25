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
                    <form action="{{route('produk.search')}}" method="get">
                        <input type="text" name="q" placeholder="Search...">
                        <button><img src="{{asset('images/search_3856329.png')}}" width="15" height="15"></button>
                    </form>
                </div>
            </div>
            <img class="keranjang" src="{{asset('images/shopping-cart_1055226.png')}}" alt="foto" width="50" height="50">
            <a class="profile" href="{{route('profile')}}"><img src="{{asset('images/profile.png')}}" width="55" height="55"></a>
        </div>
    </div>

    <h1>Main page</h1>

    <div class="ltr">
        @foreach ($produk as $item)
        <div class="itembarang">
            <img src="{{asset('images/'.$item->gambar_produk)}}" alt="foto" width="275" height="200"  class="gambar-produk">
        <h3>{{$item->nama_produk}}</h3>
        <p class="stok">({{'Stok: '.$item->stok_produk}})</p>
        <p class="harga">{{'Rp. '.$item->harga_produk}}</p>
        <a href="{{route('tampilan_login')}}"><button class="btnbeli">Beli</button></a>
        </div>
        @endforeach
    </div>

    <footer>
        <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
    </footer>

</body>

</html>