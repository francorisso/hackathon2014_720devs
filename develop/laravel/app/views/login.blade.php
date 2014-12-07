@extends("layout.master")

@section("content")
<section>
	<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
</section>
@stop

@section("scripts")
<script type="text/javascript">
	var domain = "{{{ url("/") }}}";

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

		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
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


@stop