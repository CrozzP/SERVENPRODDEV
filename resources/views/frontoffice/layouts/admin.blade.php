<!DOCTYPE html>
<html lang="es">
<head>
	<title>@yield('title')</title>
	@include('frontoffice.layouts.includes.head')
	
</head> 

<body data-background-color="bg3">
	<div class="wrapper">
		@include('frontoffice.layouts.includes.header')
		@include('frontoffice.layouts.includes.sidebar')
		<div class="main-panel">
			<div class="content">
				
			<div class="container">
				@yield('content')
			</div>

				
			</div>
			@include('frontoffice.layouts.includes.footer')
		</div>
	</div>
	@include('frontoffice.layouts.includes.foot')
	<script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</body>
</html>