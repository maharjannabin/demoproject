<?php use NepalFlag\ProductDetail; ?>
<?php use NepalFlag\ProductSize; ?>

@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Add Product Detail</h2>
		
	@yield('response-message')

	{{ Form::open(['route' => ['product-product-detail-add', 'id' => $product -> id], 'method' => 'POST']) }}
		<div class="form-group">
			{{ Form::label('size_id', 'Size Name') }}
			{{ Form::select( 'size_id', ProductSize::dropDownList(), old('size_id'), ['class' => 'form-control', 'placeholder' => 'Please choose product size'] ) }}
		</div>


		<div class="form-group">
			{{ Form::label('quantity', 'Quantity') }}
			{{ Form::text('quantity', old('quantity'), ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('price', 'Price')}} <br >
			{{ Form::text('price', old('price'), ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('order', 'Position')}} <br >
			{{ Form::text('order', old('order'), ['class' => 'form-control']) }}
		</div>

		<div class="form-group">
			{{ Form::label('is_disabled', 'Status')}} <br >
			Active: {{ Form::radio('is_disabled', ProductDetail::ACTIVE, true) }} 

			InActive: {{ Form::radio('is_disabled', ProductDetail::INACTIVE) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::textArea('description', old('description'), ['class' => 'form-control']) }}
		</div>
		 {{ Form::hidden('product_id', $product -> id)}}

		{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
		<a href="{{ route('product-detail-view', ['id' => $product -> id]) }}" class="btn btn-danger btn-sm">Cancel</>
	{{ Form::close() }}
</main>


@endsection