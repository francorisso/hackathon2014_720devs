@extends("layout.master")

@section("content")
<section>
  <a href="{{ action('TopicController@getAdd'); }}">Create topic</a>
</section>
@stop
