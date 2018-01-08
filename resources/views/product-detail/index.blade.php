<?php use NepalFlag\ProductDetail; ?>
<?php use Config as Con; ?>

@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
    <h2>Product Details</h2>
    
    @yield('response-message')

	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      	<th>#ID</th>
				<th>Size</th>
				<th>Quantity</th>
				<th>Price</th>
				<th>Status</th>
				<th>Description</th>
			</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$productDetails -> isEmpty())
	  			@foreach($productDetails as $key => $productDetail)
					<tr>
						<td>{{ $productDetail -> id }}</td>
						<td>{{ $productDetail -> size -> name }}</td>
						<td>{{ $productDetail -> quantity }}</td>
						<td>{{ $productDetail -> price  }}</td>
						<td>{{ ($productDetail -> is_disabled == ProductDetail::ACTIVE ) ? 'Active':'Inactive'}}</td>
						<td>{{ $productDetail -> description }}</td>
					</tr>
				@endforeach
	  		@else 
                <tr>
                    <td class="text-center">No Records Found</td>
                </tr>
	  		@endif
	  	</tbody>
	</table>
	{{ $productDetails -> links(Con::get('params.paginationTemplate')) }}
</main>
@endsection