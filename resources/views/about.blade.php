<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title??env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ url('assets/images/web/logo-circle.png') }}">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles.css">
</head>

<body style="background-color: #EEEEEE;">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 10vh">
            <div class="col-md-8">
                <div class="card" style="background-color: #0099FF;">
                    <div class="card-header border-bottom-0">
                        <a href="{{ url()->previous() }}" class="text-decoration-none text-white">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $user->avatar }}" alt="" class="rounded-circle shadow border-white img-fluid w-25">
                        <h4 class="text-white">{{ $user->name }}</h4>
                        <h6>{{ $user->email }}</h6>
                        <p class="text-white">Website ini menggunakan freamwork Laravel 8 untuk pembuatanya</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</body>

</html>
