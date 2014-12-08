@extends("layout.master")

@section("content")

<div class="container-fluid min-height100 clearfix">
	<div class="board-list add-wrapper clearfix">
		<a href="#" class="add-button">
			<i class="icon-more"></i>
			Add<br>Hobbies & Careers
		</a>

		<div class="search">
			{{ Form::open(array('url' => 'topics/add', 'method'=>'post')) }}
				{{ Form::hidden('mid','',array('id'=>'f_mid')) }}

				{{ Form::text('subject','',array(
											'id'=>'suggestion_box'
											,"class"=>"form-control input-lg"
											,"placeholder"=>"Ex. Garden, Photography, etc.")
								) }}<br />
				{{ Form::submit("Search",array("class"=>"btn btn-primary")) }}
			{{ Form::close() }}
		</div>
	</div><!-- /.board-list -->
</div><!-- /.container-fluid -->


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

@stop
