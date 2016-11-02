<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts/header')
    </head>
    <body>
        <div id="app">
            @include('layouts/navbar')
            @yield('header')
            <div class="container">
            @yield('content')
            </div>
            @include('layouts/footer')
        </div>
    </body>
    </html>
