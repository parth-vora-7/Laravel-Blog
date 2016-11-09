@extends('layouts.app')

@section('content')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Registration</h5></div>
                    <div class="panel-body">

                        {!! Form::open(['url' => 'register', 'method' => 'POST', 'files' => TRUE,
                        'class' => 'form-horizontal', 'role' => "form"]) !!}


                        @include('profile.partials.userfields', ['btntitle' => 'Register'])

                        {!! Form::close() !!}

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('password/reset') }}" class="btnbtn-link">Reset password</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-block btn-social btn-facebook" href="{{ URL::route('auth.facebook') }}">
                                    <span class="fa fa-facebook"></span> Sign in with Facebook
                                </a>
                                <a class="btn btn-block btn-social btn-twitter" href="{{ url::route('auth.twitter') }}">
                                    <span class="fa fa-twitter"></span> Sign in with Twitter
                                </a>
                                <a class="btn btn-block btn-social btn-google" href="{{ url::route('auth.google') }}">
                                    <span class="fa fa-google"></span> Sign in with Google
                                </a>
                                <a class="btn btn-block btn-social btn-linkedin" href="{{ url::route('auth.linkedin') }}">
                                    <span class="fa fa-linkedin"></span> Sign in with Linkedin
                                </a>
                                <a class="btn btn-block btn-social btn-github" href="{{ url::route('auth.github') }}">
                                    <span class="fa fa-github"></span> Sign in with GitHub
                                </a>
                                <a class="btn btn-block btn-social btn-bitbucket" href="{{ url::route('auth.bitbucket') }}">
                                    <span class="fa fa-bitbucket"></span> Sign in with Bitbucket
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
