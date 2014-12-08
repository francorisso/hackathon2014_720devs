@extends("layout.master")

@section("content")

<div class="container-fluid min-height100 clearfix">
	<div class="board-list add-wrapper clearfix" id="home-component">
		<a href="#" class="add-button">
			<i class="icon-more"></i>
			Add<br>Hobbies & Careers
		</a>

		<div class="search">
			{{ Form::open(array('url' => 'topics/add', 'method'=>'post')) }}
				{{ Form::hidden('mid','',array('class'=>'f_mid')) }}

				{{ Form::text('subject','',array(
											,"class"=>"form-control input-lg suggestion_box"
											,"placeholder"=>"Ex. Garden, Photography, etc.")
								) }}<br />
				{{ Form::submit("Search",array("class"=>"btn btn-primary")) }}
			{{ Form::close() }}
		</div>
	</div><!-- /.board-list -->
</div><!-- /.container-fluid -->


@stop
