<div class="comment-container">
    <div class="ajax-content">
        <h3>Blog comments</h3>
        @include('layouts.message')
        @if($blog->commenting)
        <div class="col-md-12">
            {!! Form::open(['route' => ['comment.store', $blog], 'method' => 'POST', 'files' => TRUE,
            'class' => 'form-horizontal ajax-submit add-comment', 'role' => "form"]) !!}
            <div class="error-container hidden">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>  
            </div>
            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    {!! Form::textarea('text', NULL, ['class' => 'form-control', 'required' => 'required', 'rows' => 3]) !!}

                    @if ($errors->has('text'))
                    <span class="help-block">
                        <strong>{{ $errors->first('text') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    {!! Form::submit('Add comment', ['class' => 'btn btn-primary pull-right']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @endif
        
        @if($comments->count())
        <div class="col-md-12">
            @foreach($comments as $comment)
            <div class="comment-container">
                <div class="comment" id="comment-{{ $comment->id }}">
                    {!! Form::open(['route' => ['comment.update', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit comment-edit-form', 'id' => 'comment-edit-form-' . $comment->id]) !!}
                    {{ method_field('PUT') }}
                    <div class="alert hidden" role="alert">
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
                            <em><a class="add-comment comment-collapse" href="{{ route('subcomment.index', $comment) }}">Reply</a></em>
                            @endcan
                            @can('update', $comment)
                            <em><a class="edit-comment" data-comment-id="{{ $comment->id }}">Edit</a></em>
                            @endcan
                            <em><a class="edit-comment-cancel hidden" data-comment-id="{{ $comment->id }}">Cancel</a></em>
                            @can('delete', $comment)
                            {!! Form::open(['route' => ['comment.destroy', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit comment-delete-form']) !!}
                            <em>{!! Form::submit('Delete', ['class' => 'btn-link delete-btn']) !!}</em>
                            {{ method_field('DELETE') }}
                            {!! Form::close() !!}
                            @endcan
                        </div>
                    </div>
                    <div class="ajax-content">
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-center">
                <div class="ajax-pagination">
                    {!! $comments->links() !!}
                </div>
            </div>
        </div>
        @else
        <p>No comments on this blog so far.</p>
        @endif
    </div>
</div>