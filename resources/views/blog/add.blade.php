@extends('layouts.app')

@section('content')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Add blog</h5></div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'blog.store', 'method' => 'POST', 'files' => TRUE,
                        'class' => 'form-horizontal', 'role' => "form"]) !!}

                        @include('blog.partials.blogfields', ['btntitle' => 'Add blog'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
