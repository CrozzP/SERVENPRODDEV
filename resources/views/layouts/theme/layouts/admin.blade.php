<!DOCTYPE html>
<html lang="es">
<head>
	<title>@yield('title')</title>
	@include('layouts.theme.layouts.includes.head')
	
</head> 
<body data-background-color="bg3">
	<div class="wrapper"  id="app">
		
		@include('layouts.theme.layouts.includes.header')
		@include('layouts.theme.layouts.includes.sidebar')
		<div class="main-panel">
			<div class="content">
				
			<div class="container">
				@yield('content')
			</div>
				
			</div>
			@include('layouts.theme.layouts.includes.footer')
		</div>
	</div>
	@include('layouts.theme.layouts.includes.foot')

	<script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</body>
</html>