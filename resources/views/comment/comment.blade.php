<div class="comment-container">
    <div class="ajax-content">
        <h3>Blog comments</h3>
        @if($blog->commenting)
        <div class="col-md-12">
            {!! Form::open(['route' => ['comment.store', $blog], 'method' => 'POST', 'files' => TRUE,
            'class' => 'form-horizontal ajax-submit fcomment comment-add-form', 'role' => "form"]) !!}
            @include('layouts.message')
            <div class="error-container hidden">
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>  
            </div>
            <div class="form-group">
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
                    {!! Form::open(['route' => ['comment.update', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit fcomment comment-edit-form', 'id' => 'comment-edit-form-' . $comment->id]) !!}
                    {{ method_field('PUT') }}
                    <div class="error-container hidden">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>  
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
                            <em><a class="add-comment comment-collapse btn btn-warning" href="{{ route('subcomment.index', $comment) }}"><i class="fa fa-arrow-down" aria-hidden="true"></i>Reply ({{ $comment->childComments()->count() }})</a></em>
                            @endcan
                            @can('update', $comment)
                            <em>
                            <a class="edit-comment btn btn-info" data-comment-id="{{ $comment->id }}">Edit</a>
                            <a class="edit-comment-cancel hidden btn btn-info" data-comment-id="{{ $comment->id }}">Cancel</a>
                            </em>
                            @endcan
                            @can('delete', $comment)
                            <em>
                            {!! Form::open(['route' => ['comment.destroy', $blog, $comment], 'method' => 'POST', 'role' => "form", 'class' => 'ajax-submit fcomment comment-delete-form']) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger delete-btn']) !!}
                            {{ method_field('DELETE') }}
                            {!! Form::close() !!}
                            </em>
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