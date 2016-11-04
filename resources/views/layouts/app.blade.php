<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts/header')
</head>
<body id="page-top" class="index">
	@if(Request::path() == '/')    
	@include('layouts/navbar-home')
	@else
	@include('layouts/navbar-inner')
	@endif
	@yield('content')
	@include('layouts/footer')
</body>
</html>
