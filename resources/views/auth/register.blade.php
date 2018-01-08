@extends('layouts.bootstrap4.blank')
@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
	        <span class="anchor" id="formLogin"></span>
	        <div class="card card-outline-secondary">
	            <div class="card-header">
	                <h3 class="mb-0">Register</h3>
	            </div>
	            <div class="card-block">
	            	{{ Form::open(['route' => 'register', 'class' => 'form-horizontal', 'method' => 'POST' ]) }}
	            	
	            	<div class="form-group">
	                    {{ Form::label('username', 'Username') }}
	                    {{ Form::text('username', old('username'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('email'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('username') }}</strong>
	                        </span>
	                    @endif
	                </div>
	                <div class="form-group">
	                    {{ Form::label('first_name', 'First Name') }}
	                    {{ Form::text('first_name', old('first_name'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('middle_name'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('first_name') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                <div class="form-group">
	                    {{ Form::label('middle_name', 'Middle Name') }}
	                    {{ Form::text('middle_name', old('middle_name'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('middle_name'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('middle_name') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                <div class="form-group">
	                    {{ Form::label('last_name', 'Last Name') }}
	                    {{ Form::text('last_name', old('last_name'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('last_name'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('last_name') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                <div class="form-group">
	                    {{ Form::label('email', 'Email') }}
	                    {{ Form::text('email', old('middle_name'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('email'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                <div class="form-group">
	                    {{ Form::label('phone', 'Phone') }}
	                    {{ Form::text('phone', old('phone'), ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('phone'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('phone') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                <div class="form-group">
	                    {{ Form::label('password', 'Password') }}
	                    {{ Form::password('password', ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('password'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('password') }}</strong>
	                        </span>
	                    @endif
	                </div>
					<div class="form-group">
	                    {{ Form::label('password_confirmation', 'Password Confirmation') }}
	                    {{ Form::password('password_confirmation', ['class' => 'form-control'])}}
	                    
	                    @if ($errors->has('password_confirmation'))
	                        <span class="form-control-feedback">
	                            <strong>{{ $errors->first('password_confirmation') }}</strong>
	                        </span>
	                    @endif
	                </div>

	                {{ Form::submit('Register', ['class' => 'btn btn-primary', 'id' => 'btn-register']) }}
	                {{ Form::close() }}
	            </div>
	        </div>
	    </div>
    </div>
</div>

@endsection