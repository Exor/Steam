<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 
		<title>Zombie Playground Admin | @yield('title')</title>

		@if(App::isLocal())
			{{ HTML::script('js/jquery-1.11.1.js') }}
			{{ HTML::script('js/bootstrap.js') }}
		@else
			{{ HTML::script('js/jquery-1.11.1.min.js') }}
			{{ HTML::script('js/bootstrap.min.js') }}
		@endif

		<link rel="shortcut icon" href="{{ asset('favicon.png') }}">
  	</head>
 
  	<body>

		<div class="container-fluid">
			@if(Session::has('success'))
				<div class="alert alert-success alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  {{ Session::get('success') }}
				</div>
			@elseif(Session::has('warning'))
				<div class="alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				  {{ Session::get('warning') }}
				</div>
			@elseif(Session::has('error'))
				<div class="alert alert-danger alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					@if (is_array(Session::get('error')))
					  <ul>
						@foreach (Session::get('error') as $error)
						  <li>{{ $error }}</li>
						@endforeach
					  </ul>
					@else
						{{ Session::get('error') }}
					@endif
				</div>            
			@endif

			{{ $content }}
		</div>

		<div class="container-fluid" id="legal">
		  <div class="copyright">&copy; {{date("Y")}} <a href="www.abyssalarts.com">Abyssal Arts</a></div>
		</div>

		@if(App::isLocal())
		  <div>debug data here</div>
		@endif

  	</body>
</html>