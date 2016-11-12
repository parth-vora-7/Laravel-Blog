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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
