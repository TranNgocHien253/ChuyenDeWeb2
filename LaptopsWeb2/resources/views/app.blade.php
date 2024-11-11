<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-100">
  @if(auth()->check() && auth()->user()->role === 1)
  @include('Header.headerAdmin')
  @else
  <header class="p-4 bg-white shadow-md">
    @include('Header.header')
  </header>
  <main class="p-4">
    @yield('content')
  </main>
  <footer class="p-4 bg-gray-800 text-white">
    @include('Footer.footer')
  </footer>
  @endif
</body>

</html>