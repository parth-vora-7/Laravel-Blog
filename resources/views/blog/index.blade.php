@extends('layouts.app')
@section('content')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if($blogs->all())
                <div id="blog" class="row class="col-md-10 col-md-offset-1 blogShort"> 
                   @foreach($blogs as $blog)
                   <div>
                    <h1><a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a></h1>
                    <div>
                        <em>Posted by: {{ $blog->user->name }}</em>
                        <em>Posted on: {{ $blog->published_on }}</em>
                        <em><a href="{{ route('blog.edit', $blog) }}">Edit</a></em>
                    </div>
                    <article>{{ str_limit($blog->text, 500) }}</article>
                </div>
                @endforeach
                <div class="text-center">
                    <div class="pagination">
                        {!! $blogs->links() !!}
                    </div>
                </div>
            </div>
            @else
            <div><h4>No blogs to display</h4></div>
            @endif
        </div>
    </div>
</div>
</section>
@endsection