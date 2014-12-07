@extends("layout.master")

@section("content")
<section>
	<a href="{{ action('TopicController@getIndex'); }}">Create topic</a>
</section>
@stop