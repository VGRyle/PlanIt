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
  * {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body, html {
  margin: 0;
  padding: 0; 
  font-family: 'Poppins', sans-serif;
  background:rgb(251, 251, 255) !important;
  height: 100%; 
  overflow: hidden; 
}

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;  
  width: 100%; 
}

.content {
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: auto;  
  width: 100%;
  max-width: 1200px;
  background: #FFFFFF; 
  border-radius: 20px;
  padding: 60px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); 
  text-align: center;
  color: #4A4440; 
}

.image-section, .text-section {
  flex: 1 1 50%;
  min-width: 300px;
  text-align: center;
}

.image-section img {
  max-width: 100%;
  height: auto;
}

.text-section h1 {
  font-size: 2.5rem;
  margin-bottom: 20px;
  color: black; 
}

.description {
  font-size: 1.2rem;
  color: #6e6e73;
  margin-bottom: 40px;
}

.btn {
  padding: 14px 40px;
  font-size: 1rem;
  font-weight: 600;
  color: white;
  background-color: #007aff;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  box-shadow: 0 4px 12px rgba(0, 122, 255, 0.3);
  transition: background-color 0.2s ease, box-shadow 0.2s ease;
}

.btn:hover {
  background-color: #005ecb;
  box-shadow: 0 6px 16px rgba(0, 94, 203, 0.4);
}

.signin {
  margin-top: 20px;
  font-size: 0.95rem;
}

.signin a {
  color: #007aff;
  font-weight: 600;
  text-decoration: none;
}

@media (max-width: 768px) {
  .content {
    flex-direction: column;
    padding: 40px 20px;
    text-align: center;
  }

  .text-section {
    margin-top: 30px;
  }
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
                <h1>Make Life More Organized</h1>
                <p class="description">
                PlanIt helps you organize tasks, get real-time weather, track holidays, and stay motivated—all in one place.
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
