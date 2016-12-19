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
		@can('create', $comment)
		<em><a href="" class="sub-comment">Comment</a></em>
		@endcan
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