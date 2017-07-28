<html>
	<head>
		<link rel="stylesheet" href="{{ asset('css/default.css') }}" type="text/css">
		<meta name="csrf-token" content="{{ csrf_token() }}" />
	</head>
	<body>
		<ul class="menu">
			<li><a href="/">Bands</a></li>
			<li><a href="/album">Albums</a></li>
		</ul>
		@yield('main')

		<script src="{{asset('js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
		<script src="{{asset('js/main.js')}}" type="text/javascript"></script>
		@yield('js')
	</body>
