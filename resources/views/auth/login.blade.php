@extends('layouts.bootstrap4.blank')
@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
            <span class="anchor" id="formLogin"></span>
            <!-- form card login -->
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-block">
                    {{ Form::open(['route' => 'login', 'auctocomplete' => 'off',  'role' => 'form']) }}
                        <div class="form-group">
                            {{ Form::label('email', 'Username/Email') }}
                            {{ Form::text('email', old('email'), ['class' => 'form-control'])}}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', ['class' => 'form-control'])}}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                {{ Form::submit('Login', ['class' => 'btn btn-primary'])}}
                                <a class="btn btn-success" href="{{ route('register') }}">
                                    Register
                                </a>
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>

                                
                            </div>
                        </div>
                        
                    {{ Form::close() }}
                </div>
                <!--/card-block-->
            </div>
            <!-- /form card login -->
        </div>
    </div>
</div>

@endsection
