<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>
  @include('Header.header')
  <div class="w-full px-4">
    <div class="flex gap-4">
      <div class="container shadow h-screen rounded-lg mr-5 ml-5 w-1/4 border-r-2">
        @include('Header.dashbroad')
      </div>
      <div class="w-3/4 mt-3  ">
        @yield('content')
      </div>
    </div>
  </div>
</body>

</html>