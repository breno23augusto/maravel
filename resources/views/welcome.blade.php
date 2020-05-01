<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Maravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #f15050;
            color: #ffffff;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #ffffff;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn-primary {
            color: #fff;
            background-color: #000000;
            border: none;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #673535;
            border-color: none;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Maravel
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">
                    Clique para ver todos os heróis ou pesquise:
                </a>
            </div>
            <div>
                <form action="{{route('post.show'}}" method="POST">
                    <div class="form-group mb-2">
                        <label for="hero-name" class="sr-only">Pesquise o nome do Herói</label>
                        <input type="text" class="form-control" id="hero-name">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
