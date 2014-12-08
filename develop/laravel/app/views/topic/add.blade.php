@extends("layout.master")

@section("content")
<section>
	<h2>What do you like to learn about</h2>
	{{ Form::open(array('url' => 'topics/add', 'method'=>'post')) }}
		{{ Form::hidden('mid','',array('id'=>'f_mid')) }}

		{{ Form::text('subject','',array('id'=>'suggestion_box')) }}<br />
		{{ Form::submit("GO!") }}
	{{ Form::close() }}
</section>
@stop

@section("scripts")
<script type="text/javascript">
$(function() {
	Topics.add();
});
</script>
@stop