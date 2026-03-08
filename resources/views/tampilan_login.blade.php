<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gumbira Jaya</title>
    <link rel="stylesheet" href="{{ asset('css/formlog.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/letter-g_9871677.png') }}">
</head>

<body>
    <div><img src="{{ asset('images/logoweb.png') }}" alt="foto" class="logoweb"></div>
    <div class="hellotxt">Hello,<br>Welcome<span class="txtkcl"><br>Log In to-Continue</span></div>
    <div class="db">
        <center>
            <table class="table">
                <form action="proses_login.php" method="post">
                    <tr>
                        <td>
                            <h1 style="text-align: center;">Login Account<br></h1>
                        </td>
                    </tr>
                    <tr>
                        <td><input class="inputdt" type="email" placeholder="Email" name="email"></td>
                    </tr>
                    <tr>
                        <td><input class="inputdt" type="password" placeholder="Password" name="password"></td>
                    <tr>
                        <td class="lupapw">Forgot Password?</td>
                    </tr>
                    </tr>
                    <tr>
                        <td style="text-align: center;"><br><button class="btnlogin">Login</button></td>
                    <tr>
                        <td class="belumpunyaakun">Don't have an account yet?<span><a href="{{asset('daftar2')}}" class="belumdaftar"> Register</a></span></td>
                    </tr>
                    </tr>
                </form>
            </table>
        </center>
    </div>
</body>

</html>