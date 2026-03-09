<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Gumbira Jaya</title>
    <link rel="icon" type="image/png" href="{{asset('images/letter-g_9871677.png')}}">
    <link rel="stylesheet" href="{{asset('css/hubungi.css')}}">
</head>

<body>
    <div id="dasb">
        <div class="nav-container">
            <img src="{{asset('images/logoweb.png')}}" class="logo" alt="foto">
            <a href="{{route('indexsudahlog')}}" class="halutama">Home</a>
            <a href="{{route('kategoritoko')}}" target="" class="kategori">Category</a>
        </div>
    </div>
    <div class="infocontact">
        <h1>Contact Us</h1>

        <div class="infokontak">
            <h2>Contact</h2>
            <p>E-mail: <a href="mailto:fauzanevanfebrian@gmail.com">fauzanevanfebrian@gmail.com</a></p>
            <p>Instagram: <a href="https://instagram.com/uzanepan" target="_blank">@uzanepan</a></p>
            <p>WhatsApp: <a href="https://wa.me/628889592318" target="_blank">+62 888 9592 318</a></p>
            <p>Address: Jl. Sirnagalih No.15, Bandung</p>
        </div>

        <form action="proses_hubungi.php" method="post">
            <div class="formsaran">
                <h2>Send Message</h2>
                <label for="nama">Name:</label>
                <input type="text" id="nama" name="nama" required placeholder="Name">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required placeholder="Email">

                <label for="pesan">Message:</label>
                <textarea name="pesan" id="pesan" rows="5" required placeholder="Give your suggestions and criticism!"></textarea>

                <button type="submit">Send</button>
            </div>
        </form>

        <div class="maps">
            <h2>Our shop location</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.947771235914!2d107.5414003!3d-7.015425199999992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68ed15be45bbb1%3A0x75052811216dac47!2sKusuma%20Djaya!5e0!3m2!1sid!2sid!4v1756030644039!5m2!1sid!2sid"
                width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
    <footer>
        <p>&copy; 2026 GumbiraJaya | All Rights Reserved</p>
    </footer>
</body>

</html>