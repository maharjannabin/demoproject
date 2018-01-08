<?php use NepalFlag\Product; ?>
<?php use NepalFlag\ProductSize; ?>


@extends('layouts.bootstrap4.main')

@include('message')


@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	<h2>Add Sales</h2>
	@yield('response-message')
		{{ Form::open(['route' => 'sales-add', 'method' => 'POST', 'id' => 'sales-add-form']) }}


			<div class="form-group">
		 		{{ Form::label('product_id', 'Product') }}
				{{ Form::select('product_id', Product::dropDownList(), old('product_id'), ['class' => 'form-control', 'placeholder' => 'Please chose product']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('product_size', 'Product Size') }}
				{{ Form::select('product_size', ProductSize::dropDownList(), old('product_size'), ['class' => 'form-control', 'placeholder' => 'Please chose product size']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('discount', 'Discount') }}
				{{ Form::text('discount', old('discount'), ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('service_charge', 'Service Charge') }}
				{{ Form::text('service_charge', old('service_charge'), ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('tax', 'Tax') }}
				{{ Form::text('tax', old('tax'), ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('quantity', 'Quantity') }}
				{{ Form::text('quantity', old('quantity'), ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
		 		{{ Form::label('sub_total', 'Sub Total/Each') }}
				{{ Form::text('sub_total', old('sub_total'), ['class' => 'form-control', 'readOnly' => true]) }}
			</div>


			<div class="form-group">	
				{{ Form::label('status', 'Status')}} <br >
				Sold: {{ Form::radio('status', 10, true ) }} 
				Pending: {{ Form::radio('status', 20) }}
			</div>

			{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'] )}}
			<a href="{{ route('product-index') }}" class="btn btn-danger btn-sm">Cancel</a>
			

		{!! Form::close() !!}
	
</main>
@endsection