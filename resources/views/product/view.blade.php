<?php  use NepalFlag\Product; ?>
<?php  use NepalFlag\ProductDetail; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    	<a href="{{ route('product-product-detail-add', ['id' => $product -> id]) }}" class="btn btn-success btn-sm float-right" > Add Product Detail</a>
    	<h2>Product</h2>
    	@yield('response-message')
    	<table class="table table-bordered">
			<thead>
				<!-- <tr>
					<th></th>
					<th></th>
				</tr> -->
			</thead>
			<tbody>
				<tr>
					<td> #ID</td>
					<td> : {{ $product -> id }}</td>
				</tr>
				<tr>
					<td> Name</td>
					<td> : {{ $product -> name }}</td>
				</tr>
				<tr>
					<td>Category</td>
					<td> : {{ $product -> category -> name }}</td>
				</tr>
				<tr>
					<td>Status</td>
					<td> : {{ $product -> status == Product::ACTIVE ? 'Active':'InActive' }}</td>
				</tr>
				<tr>
					<td>Weight</td>
					<td> : {{ $product -> weight }}</td>
				</tr>
				<tr>
					<td>Brand</td>
					<td> : {{ $product -> brand -> name }}</td>
				</tr>
			</tbody>
		</table>
    	
    
    	<h2>Product Detail</h2>
    	<table class="table table-bordered">
			<thead>
				<tr>
					<th>#ID</th>
					<th>Size</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Status</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>

			<tbody>
				@if (!$product -> productDetails -> isEmpty())
					@foreach($product -> productDetails as $productDetail)
						<tr>
							<td>{{ $productDetail -> id }}</td>
							<td>{{ $productDetail -> size -> name }}</td>
							<td>{{ $productDetail -> quantity }}</td>
							<td>{{ $productDetail -> price  }}</td>
							<td>{{ ($productDetail -> is_disabled == ProductDetail::ACTIVE ) ? 'Active':'Inactive'}}</td>
							<td>{{ $productDetail -> description }}</td>
							<td>
								<a href="{{ route('product-product-detail-update', ['id' => $productDetail -> id]) }}">Edit</a> |
								<a href="{{ route('product-product-detail-delete', ['id' => $productDetail -> id]) }}">Delete</a>
							</td>
						</tr>
					@endforeach
				@endif
			</tbody>
		</table>

	
    
	
	
</main>

@endsection