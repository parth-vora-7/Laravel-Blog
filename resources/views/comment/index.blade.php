<h3>Blog comments</h3>
@if($comments->count())
<div class="col-md-12">
	@foreach($comments as $comment)
	<div class="comment row">
		{!! Form::open(['route' => ['comment.update', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit comment-edit-form']) !!}
		{{ method_field('PUT') }}
		<div class="alert alert-danger hidden" role="alert">
			<ul></ul>
		</div>
		<div class="form-group">
			<textarea name="text" class="form-control hidden">{!! $comment->text !!}</textarea>
			<blockquote>{!! $comment->text !!}</blockquote>
		</div>
		{!! Form::close() !!}
		<div class="blog-footer">
			<div class="blog-info">
				<p>Posted by: <em>{{ $comment->user->name or 'Anonymous' }}</em><span>on</span><em>{{ $comment->created_at }}</em></p>
			</div>
			<div class="blog-actions">
				@can('update', $comment)
				<em><a href="" class="edit-comment">Edit</a></em>
				@endcan
				<em><a href="" class="edit-comment-cancel hidden">Cancel</a></em>
				@can('delete', $comment)
				{!! Form::open(['route' => ['comment.destroy', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit comment-delete-form']) !!}
				<em>{!! Form::submit('Delete', ['class' => 'btn-link']) !!}</em>
				{{ method_field('DELETE') }}
				{!! Form::close() !!}
				@endcan
			</div>
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