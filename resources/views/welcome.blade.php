<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{mix('/css/app.css')}}">
    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> --}}

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            /* font-family: 'Poppins', sans-serif; */
            /* font-weight: 200; */
            height: 100vh;
            margin: 0;
        }

        .title {
            font-size: 54px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        label{
            color: #FF770A;
            text-transform: capitalize;
            /* font-weight: 300; */
        }
        .form-control:focus{
            box-shadow: none;
            border: 1px solid #4BD34A;
        }
        .btn-success{
            font-weight: 300;
        }
        .btn-success:focus{
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="content" id="app">
       <home-component></home-component>
    </div>

    <script src="{{mix('/js/app.js')}}"></script>
</body>

</html>
