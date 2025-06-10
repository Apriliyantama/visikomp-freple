<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freple | Visikomp</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Header/Navbar -->
    <header class="navbar">
        <div class="logo">FRE<br>PLE</div>
        <div class="nav-text">Visi Komputer &nbsp;&nbsp; Kel.3</div>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h2>"Cara Cepat melihat tingkat<br>kematangan apel dengan deteksi"</h2>

        <div class="content-box">
            <img src="{{ asset('images/apple.png') }}" alt="App Preview" class="mockup">

            <div class="buttons">
                <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="button-group">
                        <input type="file" name="image" id="image" accept="image/*" onchange="this.form.submit()" hidden>
                        <label for="image" class="cta-button">Input Gambar</label>
                        <a href="{{ route('sample.download') }}" class="cta-button">Coba Sampel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
