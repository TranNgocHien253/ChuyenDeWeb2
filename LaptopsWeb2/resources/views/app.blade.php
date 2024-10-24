<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>
  @include('Header.header')
  <div class="container mx-auto px-4 mt-5">
    @yield('content')
  </div>
</body>
</html>