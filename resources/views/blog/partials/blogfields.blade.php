@include('message.message')
{{-- @include('errors.error') --}}

<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title" class="col-md-2 col-md-offset-1 control-label">Blog title</label>
    <div class="col-md-8">
        {!! Form::text('title', NULL, ['class' => 'form-control', 'autofocus' => 'autofocus', 'required' => 'required']) !!}

        @if ($errors->has('title'))
        <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
    <label for="text" class="col-md-2 col-md-offset-1 control-label">Blog text</label>
    <div class="col-md-8">
        {!! Form::textarea('text', NULL, ['class' => 'form-control ckeditor', 'required' => 'required']) !!}

        @if ($errors->has('text'))
        <span class="help-block">
            <strong>{{ $errors->first('text') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }} tags-container">
    <label for="tags" class="col-md-2 col-md-offset-1 control-label">Tags</label>
    <div class="col-md-8">
        {!! Form::select('tag_list[]', $tags, NULL, ['class' => 'form-control', 'required' => 'required', 'id' => 'tags', 'multiple' => 'multiple']) !!}
        @if ($errors->has('tags'))
        <span class="help-block">
            <strong>{{ $errors->first('tags') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('published_on') ? ' has-error' : '' }}">
    <label for="published_on" class="col-md-2 col-md-offset-1 control-label">Published on</label>
    <div class="col-md-8">
        <div class="input-group date" id="published_on">
            {!! Form::text('published_on', NULL, ['class' => 'form-control', 'required' => 'required']) !!}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        @if ($errors->has('published_on'))
        <span class="help-block">
            <strong>{{ $errors->first('published_on') }}</strong>
        </span>
        @endif
    </div>
</div>

@if(isset($blog))
<div class="form-group">
    <label for="blog_image" class="col-md-2 col-md-offset-1 control-label">Current blog pic</label>
    <div class="col-md-8">
        <img src="{{ asset(Helper::getImageThumb($blog->blog_image, 70, 70)) }}" />  
    </div>
</div>
@endif

<div class="form-group{{ $errors->has('blog_image') ? ' has-error' : '' }}">
    <label for="avatar" class="col-md-2 col-md-offset-1 control-label">Select new blog pic</label>
    <div class="col-md-8">
        @if(isset($blog->blog_image))
        {!! Form::file('blog_image', ['class' => 'form-control']) !!}
        @else
        {!! Form::file('blog_image', ['class' => 'form-control', 'required' => 'required']) !!}
        @endif
        
        @if ($errors->has('blog_image'))
        <span class="help-block">
            <strong>{{ $errors->first('blog_image') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-5">
        {!! Form::submit($btntitle, ['class' => 'btn btn-primary']) !!}
    </div>
</div>