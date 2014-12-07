@extends("layout.master")

@section("content")

<div class="container-fluid clearfix">
	<div class="board-list clearfix">
		<div class="list" id="grid">
			
			<div class="col-sm-6 col-lg-4 item">
				<div class="box special-box">
					<div class="panel-heading">Books</div>
					<div class="panel-body">
						<p>Here a list of books you may find interesting</p>
						<ul class="list-group">
							@if(!empty($books))
								@foreach ($books as $book)
									<li class="list-group-item">
										<a href="#" target="_blank">
											<h4 class="list-group-item-heading">{{ $book["name"] }}</h4>
											<p class="list-group-item-text">description</p>
										</a>
									</li>
								@endforeach
							@endif
						</ul>
					</div>
				</div><!-- /.special-box Learn -->
			</div>

			<div class="col-sm-6 col-lg-4 item">
				<div class="box special-box2">
					<div class="panel-heading">Movies</div>
					<div class="panel-body">
						<p>List of movies related with {{ $subject }}</p>
						<ul class="list-group">
						@if(!empty($films))
							@foreach ($films as $film)
								<li class="list-group-item">
									<a href="#" target="_blank">
										<h4 class="list-group-item-heading">{{ $film["name"] }}</h4>
										<span>Subheading</span>
										<p class="list-group-item-text">Description</p>
									</a>
								</li>
							@endforeach
						@endif
						</ul>
					</div>
				</div><!-- /.special-box Jobs -->
			</div>

			@if(!empty($videos))
				@foreach ($videos as $video)
					<div class="col-sm-6 col-lg-4 item">
						<div class="box video">
							<div class="panel-body">
								<div class="page-header">
									<h2>{{ $video["snippet"]["title"] }}</h2>
								</div>
								<p>{{ Str::words($video["snippet"]["description"],20) }}...</p>
								<figure>
									<a class="fancyvideo" data-fancybox-type="iframe" href="{{ url("/videos/details/".$video["id"]) }}">
										<img src="{{ $video["snippet"]["thumbnails"]["high"]["url"] }}" alt="{{ $video["snippet"]["title"] }}" />
									</a>
								</figure>
							</div>
							<div class="panel-footer clearfix">
								<a href="{{{ url('/boards/add/'.$video["id"]) }}}" class="btn btn-default btn-sm board-add">
									<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Add to my board
								</a>
							</div>
						</div><!-- /.video -->
					</div>
				@endforeach
			@endif

		</div>
	</div>
</div>

@stop

@section("scripts")
	<script type="text/javascript">
		ListView.init();
	</script>
@stop