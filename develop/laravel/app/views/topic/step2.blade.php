@extends("layout.master")

@section("content")
<section>
	{{ Form::open( array('url'=>'topics/step3', 'method'=>'post') ) }}
	
		{{ Form::hidden('subject', $subject) }}

		<h2>What do you like to learn about {{{ $subject }}}</h2>
		<ul style="list-style:none;">
			@foreach ($topics as $topic)
				<?php 
				$topic_thumb = null;
				if(!empty($topic["output"]["/common/topic/image"])){
					$topic_thumb = $topic["output"]["/common/topic/image"]["/common/topic/image"][0]['mid']; 	
				}
				?>
				<li style="float:left; width:800px;">
					{{ Form::checkbox("topicId[]", $topic["mid"]) }}
					@if(!empty($topic_thumb))
						<figure style="float:left; width:255px;">
							<img src="https://usercontent.googleapis.com/freebase/v1/image/{{{ $topic_thumb }}}?maxwidth=225&maxheight=225&mode=fillcropmid" />
						</figure>
					@endif
					<p style="float:left; margin-left:45px; width:500px;">
						<h3>{{{ $topic["name"] }}}</h3>
						<i>{{{ substr($topic["output"]["/common/topic/description"]["/common/topic/description"][0],0,100) }}}</a></i>
					</p>
				</li>
			
			@endforeach
		</ul>
		<div style="width:100%">
			{{ Form::submit("GO!") }}
		</div>
	{{ Form::close() }}
</section>
@stop