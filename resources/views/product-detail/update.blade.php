<?php use NepalFlag\ProductDetail; ?>
<?php use NepalFlag\ProductSize; ?>

@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Add Product Detail</h2>
		
	@yield('response-message')

	{{ Form::open(['route' => ['product-product-detail-update', 'id' => $productDetail -> id], 'method' => 'POST']) }}
		<div class="form-group">
			{{ Form::label('size_id', 'Size Name') }}
			{{ Form::select( 'size_id', ProductSize::dropDownList(), $productDetail -> size_id, ['class' => 'form-control', 'placeholder' => 'Please choose product size'] ) }}
		</div>


		<div class="form-group">
			{{ Form::label('quantity', 'Quantity') }}
			{{ Form::text('quantity', $productDetail -> quantity, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('price', 'Price')}} <br >
			{{ Form::text('price', $productDetail -> price, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('order', 'Position')}} <br >
			{{ Form::text('order', $productDetail -> order, ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			<?php
				$detailActive 		= false;
				$detailInactive 	= false;

				if ($productDetail -> is_disabled == ProductDetail::ACTIVE)
					$detailActive 	= true;
				if ($productDetail -> is_disabled == ProductDetail::INACTIVE)
					$detailInactive	= true;

			?>
			{{ Form::label('is_disabled', 'Status')}} <br >
			Active: {{ Form::radio('is_disabled', ProductDetail::ACTIVE, $detailActive ) }} 

			InActive: {{ Form::radio('is_disabled', ProductDetail::INACTIVE, $detailInactive) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textArea('description', $productDetail -> description , ['class' => 'form-control']) }}
		</div>
		 {{ Form::hidden('product_id', $product -> id)}}

		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
		<a href="{{ route('product-detail-view', ['id' => $product -> id]) }}" class="btn btn-danger btn-sm">Cancel</>
	{{ Form::close() }}
</main>


@endsection