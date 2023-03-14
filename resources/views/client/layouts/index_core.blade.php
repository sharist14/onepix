<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="robots" content="noindex">
	<title>Metro City | Новостройки</title>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=f7f5866c-fcab-4da8-94d7-cdbdb39c7d22&lang=ru_RU"></script>
    <link href="{{ asset('/fonts/icomoon/icon-font.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/libs/animate/animate.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/style.min.css') }}" rel="stylesheet" type="text/css">

</head>
<body>
    @yield('content')


    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="{{ asset('/libs/bootstrap/js/popper.min.js') }}" defer></script>
    <script src="{{ asset('/libs/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('/libs/ofi/ofi.min.js') }}" defer></script>
    <script src="{{ asset('/libs/wowjs/wow.min.js') }}" defer></script>
    <script src="{{ asset('/js/scripts.js') }}" defer></script>


</body>
</html>