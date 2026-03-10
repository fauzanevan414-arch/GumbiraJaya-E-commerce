<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>
  <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
  <link rel="stylesheet" href="{{asset('css/category.css')}}">
</head>
<body>
  <div id="dasb">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('hubungi1')}}" target="" class="hubungi">Contact</a>
        </div>
  </div>
  <div class="ltr">
    @foreach($kategori as $k)
    <div class="buttonkategori">
      <img class="gmbr" src="{{asset('images/'.$k['gambar'])}}" alt="foto">
      <h3>{{ $k['nama'] }}</h3>
    </div>
    @endforeach
  </div>
  
  
  <footer>
    <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
  </footer>
</body>
</html>