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
	<link href="{{ url('css/main.css') }}" rel="stylesheet">

	<!-- Library styles -->
	<link href="{{ url('css/jquery.fancybox.css') }}" rel="stylesheet">

	<!-- Specials Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
</head>
	
<body class="bg-video">

<div class="container">
	<div class="row">
		<div class="col-md-4 col-sm-6">
			<div class="box video">
				<div class="panel-body">
					<div class="page-header">
						<h2>Add to board</h2>
						<p>
						<ul>
							@foreach( $boards as $board )
								<li>
									<a href="javascript:add_to_board({{ $board->id }})">{{{ $board->name }}}</a>
								</li>
							@endforeach
						</ul>
						</p><br />

						<h2>Add to a new board</h2>
						<p>
						{{ Form::open( array('url'=>'boards/add') ) }}
							{{ Form::hidden('videoId', $videoId) }}
							{{ Form::text('name') }}
							{{ Form::submit('Create and add') }}
						{{ Form::close()}}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/docs.min.js') }}"></script>
<script src="{{ url('js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
<script>
	var domain = "{{ url("/") }}";

	$(function(){
		$('.tag').click(function(e){
			e.preventDefault();
			parent.location.href = $(this).attr('href');
		});
	});

	function add_to_board( boardId, videoId ){
		var reloadBoards = function(){
			var $ = parent.$;
			parent.LoadComponents.boards(function(){
				$.fancybox.close();
			});
		};
		$.post(domain+'/boards/add-video',{"boardId": boardId, "videoId": videoId},function(){
			reloadBoards();
		});
	}
</script>

</body>
</html>