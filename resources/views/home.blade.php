<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Freple | Visikomp</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="hero">
        <h2>Fastest Way to See the freshness<br>level of apples with detection</h2>

        <div class="buttons">
            <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="button-group">
                    <input type="file" name="image" id="image" accept="image/*" onchange="this.form.submit()"
                        hidden>
                    <label for="image" class="cta-button">Input image</label>
                    <a href="{{ route('sample.download') }}" class="cta-button">Try Sample</a>
                </div>
            </form>
            {{-- <form action="{{ route('sample.download') }}" method="GET">
                <button class="cta-button" type="submit">Try Sample</button>
            </form> --}}
        </div>

        <img src="{{ asset('images/apple.png') }}" alt="App Preview" class="mockup">
    </div>
</body>

</html>
