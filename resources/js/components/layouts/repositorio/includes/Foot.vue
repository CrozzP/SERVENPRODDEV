<template>
	
	
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
	<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
	{{--@include('sweetalert::alert')--}}
	@yield('foot')

</template>