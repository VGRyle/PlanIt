<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PlanIt</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 80vh;
            width: 100%;
            max-width: 1200px;
            background: #f7efe7;
            border-radius: 20px;
            padding: 60px;
            box-shadow: 0px 0px 30px 3px #00000040;
            text-align: center;
        }

        .image-section {
            flex: 1;
            text-align: center;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-section img {
            max-width: 90%;
            height: auto;
            max-height: 100%;
        }

        h1 {
            font-size: 48px;
            color: #494242;
            margin-top: 100px;
        }

        .description {
            font-size: 20px;
            color: #494242;
            max-width: 600px;
            margin: 10px auto 0;
        }

        .btn {
            margin-top: 90px;
            padding: 15px 90px;
            font-size: 20px;
            font-weight: 600;
            color: #494242;
            background-color: #ffb35c;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .signin {
            margin-top: 20px;
            font-size: 16px;
            color: #494242;
        }

        .signin a {
            color: #ffb35c;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <div class="container">
        <div class="content">
            <div class="image-section">
                <img src="{{ asset('images/yoga.png') }}" alt="Illustration" />
            </div>
            <div class="text-section">
                <h1>Get Organized Your Life</h1>
                <p class="description">
                    Today is a simple and effective to-do list and task manager app which helps you manage time
                </p>

                {{-- Register Button --}}
                <a href="{{ route('register') }}" class="btn">Register</a>

                <p class="signin">
                    Already have an account? <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
