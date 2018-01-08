<?php use NepalFlag\Product; ?>
<?php use NepalFlag\Category; ?>
<?php use NepalFlag\Brand; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Add Product</h2>
		@yield('response-message')

		{{ Form::open(['route' => ['product-update', 'id' => $product -> id], 'method' => 'POST']) }}

		 	<div class="form-group">
		 		{{ Form::label('name', 'Product Name') }}
				{{ Form::text('name', $product -> name, ['class' => 'form-control']) }}
			</div>



			<div class="form-group">
		 		{{ Form::label('cateogry_id', 'Category') }}
				{{ Form::select('category_id', Category::dropDownList(), $product -> category_id, ['class' => 'form-control', 'placeholder' => 'Please chose category']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('brand_id', 'Brand') }}
				{{ Form::select('brand_id', Brand::dropDownList(), $product -> brand_id, ['class' => 'form-control', 'placeholder' => 'Please chose category']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('order', 'Position') }}
				{{ Form::text('order', $product -> order, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				<?php
					$statusActive 		= false;
					$statusInactive 	= false;

					if ($product -> is_disabled == Product::ACTIVE)
						$statusActive 		= true;
					if ($product -> is_disabled == Product::INACTIVE)
						$statusInactive		= true;

				?>
				{{ Form::label('is_disabled', 'Status')}} <br >
				Active: {{ Form::radio('is_disabled', Product::ACTIVE, $statusActive ) }} 

				InActive: {{ Form::radio('is_disabled', Product::INACTIVE, $statusInactive) }}
			</div>

			{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'] )}}
			<a href="{{ route('product-index') }}" class="btn btn-danger btn-sm">Cancel</a>
			

		{!! Form::close() !!}
	
</main>
@endsection