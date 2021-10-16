<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Found - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
</head>

<body>
    <div id="error">

        <div class="container text-center pt-32">
            <h1 class='error-title'>404</h1>
            <p>Halaman atau link yang anda cari tidak diketahui. Mohon jangan melakukan aneh aneh ya.... Ok</p>
            <a href="{{ url()->previous() }}" class='btn btn-primary'>Kembali</a>
        </div>

        <div class="footer pt-32">
            <p class="text-center">Copyright &copy; b@yu4lex@ndr!4 {{ date('Y') }}</p>
        </div>
    </div>
</body>

</html>
