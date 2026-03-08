<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Gumbira Jaya</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/formdaftar.css')}}">
</head>

<body>
    <div><img src="{{asset('images/logoweb.png')}}" alt="foto" class="logoweb"></div>
    <div class="hellotxt">Hello,<br>Welcome<span class="txtkcl"><br>Register to-Continue</span></div>
    <div class="db">
        <center>
            <form action="{{route('daftar')}}" method="post">
            @csrf
            <table class="table">
                    <tr>
                        <td>
                            <h1 style="text-align: center;">Register Account<br></h1>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="inputdt" type="text" placeholder="Name" name="nama_user"></td>
                    </tr>
                    <tr>
                        <td><input class="inputdt" type="email" placeholder="Email" name="email"></td>
                    </tr>
                    <tr>
                        <td><input class="inputdt" type="password" placeholder="Password" name="password"></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><br><button class="btndaftar" type="submit">Register</button></td>
                    <tr>
                        <td class="sudahlogin">Have an account?<span><a href="{{asset('tampilan_login')}}" class="sudahhlogin"> Login</a></span></td>
                    </tr>
                    </tr>
@error('email')
<p style="color:red">{{ $message }}</p>
@enderror
            </table>
            </form>
        </center>
    </div>
</body>

</html>