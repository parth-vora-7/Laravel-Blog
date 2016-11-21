<h3>Blog comments</h3>
@if($comments->count())
<div class="col-md-12">
	@foreach($comments as $comment)
	<blockquote>{!! $comment->text !!}</blockquote>
	<div class="blog-footer pull-right">
		<div class="blog-info">
			Posted by: <em>{{ $comment->user->name or 'Anonymous' }}</em><span>on</span><em>{{ $comment->created_at }}</em>
			<em>Edit</em>
			{!! Form::open(['route' => ['comment.destroy', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit']) !!}
			<em>{!! Form::submit('Delete', ['class' => 'btn-link']) !!}</em>
			{{ method_field('DELETE') }}
			{!! Form::close() !!}
		</div>
	</div>
	@endforeach
	<div class="text-center">
		<div class="ajax-pagination pagination">
			{!! $comments->links() !!}
		</div>
	</div>
</div>
@else
<p>No comments on this blog so far.</p>
@endif