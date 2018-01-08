<?php use NepalFlag\Brand; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Update Brand</h2>
		
	@yield('response-message')

	{{ Form::open(['route' => ['brand-update', 'id' => $brand -> id], 'method' => 'POST']) }}
		<div class="form-group">
			{{ Form::label('name', 'Brand Name') }}
			{{ Form::text('name', $brand -> name, ['class' => 'form-control']) }}
			
		</div>


		<div class="form-group">
			{{ Form::label('order', 'Position') }}
			{{ Form::text('order', $brand -> order, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			<?php
				$brandActive 	= false;
				$brandInactive 	= false;

				if ($brand -> is_disabled == Brand::ACTIVE)
					$brandActive 	= true;
				if ($brand -> is_disabled == Brand::INACTIVE)
					$brandInactive	= true;

			?>
			{{ Form::label('is_disabled', 'Status')}} <br >
			Active: {{ Form::radio('is_disabled', Brand::ACTIVE, $brandActive) }} 

			InActive: {{ Form::radio('is_disabled', Brand::INACTIVE, $brandInactive) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textArea('description', $brand -> description, ['class' => 'form-control']) }}
		</div>


		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
		<a href="{{ route('brand-index') }}" class="btn btn-danger btn-sm">Cancel</>
	{{ Form::close() }}
</main>


@endsection