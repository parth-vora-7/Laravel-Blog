<div class="row">
    <div class="col-md-12">
        {!! Form::open(['route' => ['blog.comment.store', $blog], 'method' => 'POST', 'files' => TRUE,
        'class' => 'form-horizontal ajax-submit', 'role' => "form"]) !!}

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
</div>