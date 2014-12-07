@extends("layout.master")

@section("content")
<section>
	<h2>What do you like to learn about</h2>
	{{ Form::open(array('url' => 'topics/step2', 'method'=>'post')) }}
		{{ Form::hidden('step',2) }}
		{{ Form::hidden('mid','',array('id'=>'f_mid')) }}

		{{ Form::text('subject','',array('id'=>'suggestion_box')) }}<br />
		{{ Form::submit("GO!") }}
	{{ Form::close() }}
</section>
@stop

@section("scripts")
<script type="text/javascript">
$(function() {
	$("#suggestion_box")
	.suggest({ key: "{{ $google_api_key }}" })
	.bind("fb-select", function(e, data){
		if( typeof data != 'undefined' && typeof data.mid != 'undefined' ){
			$('#f_mid').val( data.mid );	
		}
;	});
});
</script>
@stop