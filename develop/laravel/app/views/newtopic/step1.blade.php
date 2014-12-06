@extends("layout.master")

@section("content")
<section>
	<h2>What do you like to learn about</h2>
	{{ Form::open(array('action' => array( 'HomeController@index'), 'method'=>'post')) }}
		{{ Form::hidden('step',2) }}

		{{ Form::text('subject') }}<br />
		{{ Form::submit("GO!") }}
	{{ Form::close() }}
</section>
@stop