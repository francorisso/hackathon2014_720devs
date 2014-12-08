<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="ico/favicon.ico">
	<link rel="apple-touch-icon" href="ico/apple-touch-icon.png">

	<title>Hobbies and Careers</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="{{ url('/css/landing.css') }}" rel="stylesheet">

	<!-- Library styles -->
	<link href="{{ url('/css/superslides.css') }}" rel="stylesheet">
	<link href="{{ url('/css/jquery.fancybox.css') }}" rel="stylesheet">

	<!-- Specials Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic' rel='stylesheet' type='text/css'>
</head>

<body>

<section class="slider" id="video-tour">
	
	<div id="slider-top">
		<div class="slides-container">
			<img src="{{ url('/images/slider1.jpg') }}" alt="Slider 1">
			<img src="{{ url('/images/slider2.jpg') }}" alt="Slider 2">
		</div>
	</div>

	<div id="caption">
		<div class="caption">
    		<div class="text">
    			<h2>
    				Start learning for free!
					<strong>Your hobby may become your career</strong>
    			</h2>
    			<div class="buttons">
    				<a href="#" onclick="javascript:fb_login();" rel="no-follow" class="btn-xl fb">Facebook SIGN UP</a>
    			</div>
    		</div>
    	</div>
	</div>
</section>
<!-- /#slider-top -->

<div class="navbar-fixed">
	<div class="navbar navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1 class="logo navbar-brand">
					<a href="{{ url("/") }}">Hobbies and Careers</a>
				</h1>
			</div>

			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#features">Features</a></li>
					<li><a href="#sign-up">Sign Up</a></li>
				</ul>
			</div>
		</div>
	</div>
</div><!-- /.navbar-fixed -->

<div class="container-fluid bg-grey" id="features">
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h2>Features</h2>
				<h3>Get the best from Youtube.</h3>
			</div>

			<div class="col-lg-4">
				<h2>Fun Learning</h2>
				<p>Learn based on youtube videos.</p>
			</div><!-- /.col-lg-4 -->

			<div class="col-lg-4">
				<h2>Personal Recomendations</h2>
				<p>You get better recommendations as you learn what you want.</p>
			</div><!-- /.col-lg-4 -->

			<div class="col-lg-4">
				<h2>Get extra information</h2>
				<p>Get books, films, careers and more about your interest.</p>
			</div><!-- /.col-lg-4 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.container-fluid -->

<!--<div class="container features">
	<div class="row featurette">
		<div class="col-md-7">
			<h2 class="featurette-heading">Learn watching videos. <span class="text-muted">It'll blow your mind.</span></h2>
			<p class="lead">.</p>
		</div>

		<div class="col-md-5">
			<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-5">
			<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
		</div>
		<div class="col-md-7">
			<h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
			<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
		</div>
	</div>

	<hr class="featurette-divider">

	<div class="row featurette">
		<div class="col-md-7">
			<h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
			<p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
		</div>
		<div class="col-md-5">
			<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
		</div>
	</div>
</div><!-- /.container -->

<div class="container-fluid" id="sign-up">
	<h2>
		Start learning for free!
		<strong>Your hobby may become your career</strong>
	</h2>
	<div class="buttons">
		<a href="#" onclick="javascript:fb_login();" rel="no-follow" class="btn-xl fb">Facebook SIGN UP</a>
	</div>
</div><!-- /.container -->

<div class="container">
	<footer>
		<p class="pull-right"><a href="#video-tour">Back to top</a></p>
		<p>&copy; {{ date("Y") }} &middot; <a href="http://www.720developments.com/" target="_blank">720 Developments</a> &middot; All rights reserved</p>
	</footer>
</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/docs.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.animate-enhanced.min.js"></script>
<script src="js/jquery.superslides.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/main.js"></script>
<script type="text/javascript"> 
	slider.init();
	scrollMenu.init();
	fancybox2.init();
</script>
<script type="text/javascript">
	var domain = "{{{ url("/") }}}";

	function fb_login(){
		FB.login(function(response) {
			checkLoginState();
	    }, {
	        scope: 'public_profile,email'
	    });
	}

	// This is called with the results from from FB.getLoginStatus().
	function statusChangeCallback(response) {
		if (response.status === 'connected') {
			FB.api( '/me', function(response) {
				$.post(domain + "/users/login", response, function(res){
					location.reload();
				});
			});	
		}
	}

	// This function is called when someone finishes with the Login
	// Button.  See the onlogin handler attached to it in the sample
	// code below.
  	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '312830828910502',
			cookie     : true,  // enable cookies to allow the server to access 
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.1' // use version 2.1
		});
  	};

	// Load the SDK asynchronously
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));

</script>
</body>
</html>