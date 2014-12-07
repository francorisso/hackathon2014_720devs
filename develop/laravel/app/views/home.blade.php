@extends("layout.master")

@section("content")

<div class="container-fluid min-height100 clearfix">
	<div class="board-list add-wrapper clearfix">
		<a href="#" class="add-button">
			<i class="icon-more"></i>
			Add<br>Hobbies & Careers
		</a>

		<div class="search">
			<input class="form-control input-lg" type="text" placeholder="Ex. Garden, Photography, etc.">
			<button type="button" class="btn btn-primary">Search</button>
		</div>
	</div><!-- /.board-list -->

	<div class="user">
		<div class="profile">
			<img src="images/profile.jpg" alt="" class="img-circle">
			<span class="name">Mariana Stariolo</span>
			<span><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i> Córdoba, Argentina</span>
		</div>

		<h3>Your Interested:</h3>
		<a href="#" class="add-button">
			<i class="icon-more"></i>
			Add
		</a>
	</div><!-- /.user -->
</div><!-- /.container-fluid -->

@stop
