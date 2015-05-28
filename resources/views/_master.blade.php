<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,200' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		
		<script src ="http://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		<link href='http://fonts.googleapis.com/css?family=Port+Lligat+Sans' rel='stylesheet' type='text/css'>
		<script src="js/script.js" type="text/javascript" rel="javascript"></script>
		<title>
			Middlesex Clubs
			@yield('title')
		</title>
			@yield('head')
	</head>
	<body>
		<header>
			<div id="head-left" class="head"><a href="/"><img id="emblem" src="emblem.png"/></a></div>
			<div id="head-center" class="head">
			<a href="/">Middlesex Clubs</a>
			</div>
			<div id="head-right" class="head">
			@if(Session::get('username'))
				<a class="head" href="/newpost">Write Post &middot</a>
				<a class="head" class="rightmost" href="/logout">Log Out</a>
			@endif
			@if(!(Session::get('username')))
				<a class="head" href="/login">Log In &middot</a>
				<a class="head" class="rightmost" href="/signup">Sign Up</a>
			@endif
			</div>
		</header>
		@yield('content')
		<footer>Torres & Co. &copy 2015</footer>
	</body>
</html>
