<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="{{ url('/ico/favicon.png') }}">
	<link rel="apple-touch-icon" href="{ url('ico/favicon.png') }}">

	<title>Hobbies and Careers</title>

	<link type="text/css" rel="stylesheet" href="https://www.gstatic.com/freebase/suggest/4_1/suggest.min.css" />

	<!-- Bootstrap core CSS -->
	<link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="{{ url('/css/main.css') }}" rel="stylesheet">

	<!-- Library styles -->
	<link href="{{ url('/css/jquery.fancybox.css') }}" rel="stylesheet">

	<!-- Specials Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
	
<body>

<div class="navbar-fixed">
	<div class="navbar navbar-white navbar-static-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1 class="logo navbar-brand">
					<a href="{{{ url("/") }}}">Hobbies and Careers</a>
				</h1>
			</div>

			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown" id="component-boards">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">My Boards <b class="caret"></b></a>
						<ul class="dropdown-menu"></ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div><!-- /.navbar-fixed -->

@yield("content")


<div class="user">
	<div class="profile">
		<img src="" alt="Profile Image" class="img-circle">
		<span class="name">{{ Auth::user()->username }}</span>
		<span>
			<i class="glyphicon glyphicon-off" aria-hidden="true"></i>
			<a href="{{ url("users/logout") }}">Logout</a>
		</span>
	</div>

	<h3>Your Interests:</h3>
	<div class="tags" id="component-topics"></div>
	<a href="#" class="add-button">
		<i class="icon-more"></i>
		Add
	</a>
	<div class="search">
		{{ Form::open(array('url' => 'topics/add', 'method'=>'post')) }}
			{{ Form::hidden('mid','',array('class'=>'f_mid')) }}

			{{ Form::text('subject','',array(
										"class"=>"form-control input-lg suggestion_box"
										,"placeholder"=>"Ex. Garden, Photography, etc.")
							) }}<br />
			{{ Form::submit("Search",array("class"=>"btn btn-primary")) }}
		{{ Form::close() }}
	</div>

</div><!-- /.user -->

	<!-- Bootstrap core JavaScript
	================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript">
		var $ = $.noConflict();
	</script>
	<script type="text/javascript" src="https://www.gstatic.com/freebase/suggest/4_1/suggest.min.js"></script>
	<script type="text/javascript">
		$(".suggestion_box").each(function(){
			var element = $(this);
			$(this).suggest({ key: "{{ $google_api_key }}" })
			.bind("fb-select", function(e, data){
				if( typeof data != 'undefined' && typeof data.mid != 'undefined' ){
					element.parent().find('.f_mid').val( data.mid );	
				}
			});
		});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		var $ = $.noConflict();
	</script>
	<script src="{{ url('/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('/js/docs.min.js') }}"></script>
	<script src="{{ url('/js/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ url('/js/masonry.pkgd.min.js') }}"></script>
	<script src="{{ url('/js/imagesloaded.pkgd.min.js') }}"></script>
	<script src="{{ url('/js/main.js') }}"></script>
	<script type="text/javascript"> 
		fancybox.init();
	</script>

	@yield("scripts")

	<script type="text/javascript">
	var domain = "{{{ url("/") }}}";

	function logout(){
		$.post(domain + "/users/logout", null, function(res){
			FB.logout(function(response){
		        location.reload();
		    });
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '312830828910502',
			cookie     : true,  // enable cookies to allow the server to access 
			xfbml      : true,  // parse social plugins on this page
			version    : 'v2.1' // use version 2.1
		});
		FB.getLoginStatus(function(response) {
			LoadComponents.profilePic();
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

	

	//load components
  	$(function(){
		Topics.add();
  		LoadComponents.boards();
  		LoadComponents.topics();
  	});
	</script>
</body>
</html>