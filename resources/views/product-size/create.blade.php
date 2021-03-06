<?php use NepalFlag\ProductSize; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Add Product Size</h2>
		
	@yield('response-message')

	{{ Form::open(['route' => ['product-size-add'], 'method' => 'POST']) }}
		<div class="form-group">
			{{ Form::label('name', 'Size Name') }}
			{{ Form::text('name', old('name'), ['class' => 'form-control']) }}
			
		</div>


		<div class="form-group">
			{{ Form::label('order', 'Position') }}
			{{ Form::text('order', old('order'), ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('is_disabled', 'Status')}} <br >
			Active: {{ Form::radio('is_disabled', ProductSize::ACTIVE, true) }} 

			InActive: {{ Form::radio('is_disabled', ProductSize::INACTIVE) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textArea('description', old('description'), ['class' => 'form-control']) }}
		</div>


		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
		<a href="{{ route('product-size-index') }}" class="btn btn-danger btn-sm">Cancel</>
	{{ Form::close() }}
</main>


@endsection