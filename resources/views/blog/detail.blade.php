@extends('layouts.app')

@section('content')
<section id="blog-list">
	<div class="container">
		<div>
			<div class="page-title"><h2><a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a></h2></div>
		</div>
		<div class="row">
			@include('flash::message')
			<div class="col-sm-9">
				<article>
					<div class="col-sm-3">
						<img src="{{ asset(Helper::getImageThumb($blog->blog_image, 150, 150)) }}" />
					</div>
					<div class="col-sm-9">
						<blockquote>{!! $blog->text !!}</blockquote>
						<div class="blog-footer">
							<div class="blog-info">
								<p>Posted by: <em>{{ $blog->user->name or 'Anonymous' }}</em><span>on</span><em>{{ $blog->published_on }}</em></p>
							</div>
							<div class="blog-actions">
								@can('update', $blog)
								<em><a href="{{ route('blog.edit', $blog) }}">Edit</a></em>
								@endcan
								@can('delete', $blog)
								{!! Form::open(['route' => ['blog.destroy', $blog], 'method' => 'POST', 'role' => "form"]) !!}
								<em>{!! Form::submit('Delete', ['class' => 'btn-link delete-btn']) !!}</em>
								{{ method_field('DELETE') }}
								{!! Form::close() !!}
								@endcan
							</div>
						</div>    
					</div>
				</article>
				@include('comment.comment')
			</div>
			<div class="sidebar col-sm-3">
				@include('tag.index')
			</div>
		</div>
	</div>
</section>
@endsection