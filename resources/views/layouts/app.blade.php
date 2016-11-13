<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts/header')
</head>
<body id="page-top" class="index">
	<div id="app">
		@include('layouts/navbar')
		@yield('content')
		@include('layouts/footer')
	</div>
</body>
</html>