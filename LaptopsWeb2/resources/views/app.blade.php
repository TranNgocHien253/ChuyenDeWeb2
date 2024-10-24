<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>
  @include('Header.header')
  <div class="container">
    <div class="flex">
      <div class="w-1/4">
        @include('Header.dashbroad')
      </div>
      <div class="w-3/4 mt-3  ">
        @yield('content')
      </div>
    </div>
  </div>
</body>

</html>