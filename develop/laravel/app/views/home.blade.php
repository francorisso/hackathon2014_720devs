@extends("layout.master")

@section("content")
<section>
	<h2>What do you like to learn about {{{ $subject }}}</h2>
	<ul style="list-style:none;">
		@foreach ($topics as $topic)
			<?php 
			$topic_thumb = null;
			if(!empty($topic["output"]["/common/topic/image"])){
				$topic_thumb = $topic["output"]["/common/topic/image"]["/common/topic/image"][0]['mid']; 	
			}
			?>
			<li style="float:left;">
				@if(!empty($topic_thumb))
					<figure>
						<img src="https://usercontent.googleapis.com/freebase/v1/image/{{{ $topic_thumb }}}?maxwidth=225&maxheight=225&mode=fillcropmid" />
					</figure>
				@endif
				<p>
					<a href="">{{{ $topic["name"] }}}</a>
					<i>{{{ $topic["output"]["/common/topic/description"]["/common/topic/description"][0] }}}</a></i>
				</p>
			</li>
		
		@endforeach
	</ul>
</section>
@stop