<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>@include('layouts.bootstrap4._head')</head>

	<body>
		<div id="app">
			<div class="container-fluid">
	      		<div class="row">
	      			@yield('left-side-nav')
					@yield('content')
				</div>
			</div>
			<!-- @include('layouts.bootstrap4._footer') -->
			
		</div>
		@include('layouts.bootstrap4._footer-scripts')
	</body>
</html>