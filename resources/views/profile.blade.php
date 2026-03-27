<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
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
    <div class="propil">
        <h1>HELLO!</h1>
        <img src="{{asset('images/download.jpg')}}" width="100" height="100">
    <h3>I'm <b>{{ session('nama_user') }}</b></h3>
    <p>Email: {{ session('email') }}</p>
        <div class="logout">
            <a class="back" href="/indexsudahlog">Back</a>
            <form action="/logout" method="POST">
                @csrf
                <button class="back" type="submit">Logout</button>
            </form>
        </div>

    </div>
    </div>
    
</body>
</html>