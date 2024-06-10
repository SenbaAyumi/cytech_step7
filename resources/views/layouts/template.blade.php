<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name = "cytech7">
    <title>@yield('title')</title>
    @stack('css')
</head>
<body>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
