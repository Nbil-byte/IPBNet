<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
            margin: 0;
            font-family: Arial, sans-serif;
            }

            header {
            background-color: #191E4D;
            padding: 10px 20px; /* Mengurangi padding untuk membuat navbar lebih kecil */
            }

            nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            }

            .logo img {
            height: 90px; /* Mengurangi tinggi logo */
            }

            .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            }

            .navbar li {
            display: inline-block;
            margin-left: 15px; /* Mengurangi margin antara item navbar */
            }

            .navbar li:first-child {
            margin-left: 0;
            }

            .navbar li a {
            color: #fff;
            text-decoration: none;
            font-size: 1em; /* Mengurangi ukuran font */
            }

            .hero {
            background-image: url("https://www.ipb.ac.id/wp-content/uploads/2023/10/DSC_7879-2-2048x1367.jpg");
            background-size: cover;
            background-position: center;
            height: calc(75vh - 60px); /* Mengurangi tinggi hero sesuai dengan tinggi navbar yang lebih kecil */
            display: flex;
            justify-content: flex-start; /* Menggeser konten ke kiri */
            align-items: center;
            text-align: left; /* Mengatur teks agar rata kiri */
            padding-left: 40px; /* Menambahkan padding kiri untuk memberi jarak dari tepi */
            }

            .hero-content {
            color: #fff;
            text-align: left; /* Mengatur teks agar rata kiri */
            max-width: 50%; /* Membatasi lebar maksimal teks hingga 50% dari lebar layar */
            }

            .hero-content h1 {
            font-size: 2.5em; /* Mengurangi ukuran font */
            margin-bottom: 20px;
            }

            .hero-content p {
            font-size: 1em; /* Mengurangi ukuran font */
            margin-bottom: 30px;
            }

            .btn {
            background-color: #191E4D;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            }

            .btn:hover {
            background-color: #191E4D;
            }

            .description {
            position: relative;
            }

            .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Warna transparan */
            }

            .description-content {
            position: absolute;
            top: 50%;
            left: 0; /* Menggeser konten ke kiri */
            transform: translateY(-50%); /* Hanya menggeser secara vertikal */
            color: #fff;
            text-align: left; /* Mengatur teks agar rata kiri */
            padding-left: 40px; /* Menambahkan padding kiri untuk memberi jarak dari tepi */
            }

            .description-content h2 {
            font-size: 1.8em; /* Mengurangi ukuran font */
            margin-bottom: 20px;
            }

            .description-content p {
            font-size: 1em; /* Mengurangi ukuran font */
            }

            .info-section {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            padding: 40px;
            max-width: 100%;
            }

            .info-box {
            background-color: #D9D9D9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 30%;
            padding: 20px;
            text-align: center;
            max-width: 100%;
            }

            .info-box h3 {
            font-size: 1.3em; /* Mengurangi ukuran font */
            margin-bottom: 15px;
            }

            .info-box p {
            font-size: 0.9em; /* Mengurangi ukuran font */
            color: #666;
            }

            .contact-section {
            padding: 40px;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .contact-content {
            display: flex;
            align-items: center;
            justify-content: center;
            max-width: 600px; /* Mengatur lebar maksimal untuk keseluruhan konten */
            width: 100%;
            }

            .contact-text {
            text-align: center;
            font-size: 1em; /* Mengurangi ukuran font */
            margin-left: 10px; /* Menambahkan margin kiri untuk memberi jarak dari gambar */
            }

            .contact-image {
            margin-right: 10px; /* Menambahkan margin kanan untuk memberi jarak dari teks */
            }

            .contact-image img {
            width: 60%;
            max-width: 70px; /* Mengatur ukuran maksimal gambar lebih kecil */
            border-radius: 8px;
            }
        </style>
    </head>
    <body>
        <header>
          <nav>
            <div class="logo">
                <a href="https://www.ipb.ac.id/" target="_blank" rel="noopener"><img src="https://www.ipb.ac.id/wp-content/uploads/2023/12/Logo-IPB-University_Horizontal-Putih.png" alt="IPB University" align="middle" /></a>
            </div>
            @if (Route::has('login'))
                <ul class="navbar">
                    @auth
                        <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth
                </ul>
            @endif

          </nav>
        </header>
      
        <section class="hero">
          <div class="hero-content">
            <h1 style="color:white; text-shadow: 2px 2px 8px rgba(0, 0, 0, 1), 4px 4px 8px rgba(0, 0, 0, 1);">Welcome to IPBNet</h1>
            <p style="color:white; text-shadow: 2px 2px 8px rgba(0, 0, 0, 1), 4px 4px 8px rgba(0, 0, 0, 1);">
              IPBnet adalah platform website eksklusif yang dirancang khusus untuk mahasiswa<br/>Institut Pertanian Bogor (IPB). Menyediakan hiburan dan informasi sekaligus,<br/>IPBnet adalah tempat yang sempurna bagi mahasiswa untuk berinteraksi dan terhubung. 
            </p>
            @if (Route::has('register'))<a href="{{ route('register') }}"class="btn">Get Started</a>@endif
          </div>
        </section>
      
        <section class="description">
          <div class="overlay"></div>
          <div class="description-content">
          </div>
        </section>
      
        <section class="info-section">
            <div class="info-box">
              <h3>Tell us</h3>
              <p>Ceritakan tentang momen yang ingin anda bagikan.</p>
            </div>
            <div class="info-box">
              <h3>Be Informed</h3>
              <p>Dapatkan berita terkini seputar lingkup mahasiswa IPB.</p>
            </div>
            <div class="info-box">
              <h3>Announce</h3>
              <p>Umumkan berita atau acara yang sedang terjadi.</p>
            </div>
        </section>
      
        <section class="contact-section">
          <div class="contact-content">
            <div class="contact-image">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAACXBIWXMAAAsTAAALEwEAmpwYAAABm0lEQVR4nO2WzytEURTHP2M1yn+AjA1hg42aWIzMirIQS8WCSPnxR/AfTBZYKUsbf4CkJCJsGDYSC1LIzPbp6U6u03tn3jUem/nW2bz7vefz3jn33nehqi/VADPACVAEnoEdoIEYlQC2AC8gluMEz4VA/ZiMC5oEHhRwU1zgYQV6rczLAhtAHiiYyJtn2SjgnAJeDfA3A/vKnFLsASkNfKFMHhXeDuApAtQz4Xvbw1ZzMWTSKVBneWuBGweoZ7XLX0ff1CBMt8A00BLwkkuWL0159Vr+BTnYI8DjSqJDy+cnLac+y38gB/sFOKMkev1BmT0TLzLZkDB0KuC33wSPCkMqYqnTEfrqaaV2AS9G6LHdV8+KeWkcFIYuBZw0J5Nrma+CtlNGmPzFpqkVeHeAPgJtQYlctpOvAQforvaDqRfmO2DWfJlUtzguj4B1U8qCqcQlsBahcuqReSaOTL+/98A2MGJuLBXpXCnXGDEq5/hb/PeLQMVKmt79+dUHs5LDwBPEqASwGQJeiRNcgk8Bx2Zfli70jZ+jVeGmD/kfI1TwVEsyAAAAAElFTkSuQmCC">
            </div>
            <div class="contact-text">
                <a href="wa.me/6282172755867">
                     <h2>Contact Us</h2>
                </a>
            </div>
          </div>
        </section>
        <footer style="color: black;
                   text-align: end;
                   bottom: 0;
                   width: 100%;
                   background-color: #ddd;
                   padding: 10px 0;
                   ">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>  
      </body>
</html>
