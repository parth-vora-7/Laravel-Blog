@include('errors.error')

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="name" class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
        {!! Form::text('name', NULL, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">E-mail</label>
    <div class="col-md-6">
        {!! Form::email('email', NULL, ['class' => 'form-control']) !!}

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-4 control-label">Password</label>
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control']) !!}

        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
    <label for="password_confirmation" class="col-md-4 control-label">Repeat
        password</label>
        <div class="col-md-6">
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}

            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
        <label for="contact_no" class="col-md-4 control-label">Contact no</label>
        <div class="col-md-6">
            {!! Form::number('contact_no', NULL, ['class' => 'form-control']) !!}

            @if ($errors->has('contact_no'))
            <span class="help-block">
                <strong>{{ $errors->first('contact_no') }}</strong>
            </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
        <label for="gender" class="col-md-4 control-label">Gender</label>
        <div class="col-md-6">
            <label class="radio-inline">{!! Form::radio('gender', 'male', TRUE) !!}Male</label>

            <label class="radio-inline">{!! Form::radio('gender', 'female', False) !!}
                Female</label>

                @if ($errors->has('gender'))
                <span class="help-block">
                    <strong>{{ $errors->first('gender') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            <label for="country" class="col-md-4 control-label">Country</label>
            <div class="col-md-6">
                {!! Form::select('country', ['India' => 'India', 'USA' => 'USA'], 1, ['class' => 'form-control']) !!}

                @if ($errors->has('country'))
                <span class="help-block">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('hobbies') ? ' has-error' : '' }}">
            <label for="hobbies" class="col-md-4 control-label">Hobbies</label>
            <div class="col-md-6">
                <label class="checkbox-inline">{!! Form::checkbox('hobbies[]', 'Playing cricket', NULL, ['class' => '']) !!}
                    Playing cricket</label>
                    <label class="checkbox-inline">{!! Form::checkbox('hobbies[]', 'Playing chess', NULL, ['class' => '']) !!} Playing chess</label>
                    <br>
                    <label class="checkbox-inline">{!! Form::checkbox('hobbies[]', 'Internet surfing', NULL, ['class' => '']) !!}Internet surfing</label>
                    <label class="checkbox-inline">{!! Form::checkbox('hobbies[]', 'Outing', NULL, ['class' => '']) !!}Outing</label>
                    <label class="checkbox-inline">{!! Form::checkbox('hobbies[]', 'Reading', NULL, ['class' => '']) !!}Reading</label>

                    @if ($errors->has('hobbies'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hobbies') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('about_me') ? ' has-error' : '' }}">
                <label for="about_me" class="col-md-4 control-label">About me</label>

                <div class="col-md-6">
                    {!! Form::textarea('about_me', NULL, ['class' => 'form-control']) !!}
                    @if ($errors->has('about_me'))
                    <span class="help-block">
                        <strong>{{ $errors->first('about_me') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                <label for="date_of_birth" class="col-md-4 control-label">Date of birth</label>

                <div class="col-md-6">
                    {!! Form::date('date_of_birth', \Carbon\Carbon::now()) !!}
                    @if ($errors->has('date_of_birth'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label for="avatar" class="col-md-4 control-label">Profile pic</label>
                <div class="col-md-6">
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}

                    @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {!! Form::submit($btntitle, ['class' => 'btn btn-primary']) !!}
                </div>
            </div>






