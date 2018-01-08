<?php use NepalFlag\ProductSize; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Update Brand</h2>
		
	@yield('response-message')

	{{ Form::open(['route' => ['product-size-update', 'id' => $size -> id], 'method' => 'POST']) }}
		<div class="form-group">
			{{ Form::label('name', 'Size') }}
			{{ Form::text('name', $size -> name, ['class' => 'form-control']) }}
			
		</div>


		<div class="form-group">
			{{ Form::label('order', 'Position') }}
			{{ Form::text('order', $size -> order, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			<?php
				$sizeActive 	= false;
				$sizeInactive 	= false;

				if ($size -> is_disabled == ProductSize::ACTIVE)
					$sizeActive 	= true;
				if ($size -> is_disabled == ProductSize::INACTIVE)
					$sizeInactive	= true;

			?>
			{{ Form::label('is_disabled', 'Status')}} <br >
			Active: {{ Form::radio('is_disabled', ProductSize::ACTIVE, $sizeActive) }} 

			InActive: {{ Form::radio('is_disabled', ProductSize::INACTIVE, $sizeInactive) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textArea('description', $size -> description, ['class' => 'form-control']) }}
		</div>


		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
		<a href="{{ route('product-size-index') }}" class="btn btn-danger btn-sm">Cancel</>
	{{ Form::close() }}
</main>


@endsection