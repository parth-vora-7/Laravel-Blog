@extends('layouts.app')

@section('content')
<section id="blog-list">
	<div class="container">
		<div>
			<div class="page-title"><h2>All blogs</h2></div>
		</div>
		<div class="row">
			@include('flash::message')
			<div class="col-sm-9">
				<article>
					<h2><a href="{{ route('blog.show', $blog) }}">{{ $blog->title }}</a></h2>
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
								@can('update', $blog)
								{!! Form::open(['route' => ['blog.destroy', $blog], 'method' => 'POST', 'role' => "form"]) !!}
								<em>{!! Form::submit('Delete', ['class' => 'btn-link']) !!}</em>
								{{-- <em><a href="{{ route('blog.destroy', $blog) }}">Delete</a></em> --}}
								{{ method_field('DELETE') }}
								{!! Form::close() !!}
								@endcan
							</div>
						</div>    
					</div>
				</article>
			</div>
			<div class="sidebar col-sm-3">
				<h3>sidebar comming soon</h3>
			</div>
		</div>
	</div>
</section>
@endsection