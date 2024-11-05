<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>

<body>
  @include('Header.header')

  <div class="flex gap-4 p-2">
    <div class="h-auto border rounded-lg bg-slate-200">

      @if(auth()->check() && auth()->user()->role === 1)
      @include('Header.dashbroad')
      @endif
    </div>
    <div class="w-full">

      @yield('content')
    </div>
  </div>
</body>

</html>