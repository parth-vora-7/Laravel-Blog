<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts/header')
</head>
    <body id="page-top" class="index">
        @include('layouts/navbar')
        @yield('content')
        @include('layouts/footer')
    </body>
</html>
