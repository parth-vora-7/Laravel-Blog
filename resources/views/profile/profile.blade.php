@extends('layouts.app')

@section('content')
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Edit Profile</h5></div>
                    <div class="panel-body">
                        {!! Form::model($user, ['route' => ['profile.udpate', $user], 'method' => 'POST', 'files' => TRUE,
                        'class' => 'form-horizontal', 'role' => "form"]) !!}
                        
                        {{ method_field('PUT') }}
                        @include('profile.partials.userfields', ['btntitle' => 'Update profile'])

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection