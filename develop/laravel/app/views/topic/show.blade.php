@extends("layout.master")

@section("content")
<section>
	<h2>Showing videos about {{{ $subject }}}</h2>
	<div>
		@foreach ($videos as $video)
			<article style="float:left; margin:10px;">
				<iframe width="560" height="315" src="//www.youtube.com/embed/{{{ $video["id"] }}}" frameborder="0" allowfullscreen></iframe>
			</article>
		@endforeach
	</div>


</section>
<section style="width:100%; float: left;">
	<h2>Showing books about {{{ $subject }}}</h2>
	@foreach ($books as $book)
		<a href="">{{ $book["name"] }}</a><br />
	@endforeach

</section>

@stop