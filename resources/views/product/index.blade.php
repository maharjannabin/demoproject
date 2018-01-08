<?php  use NepalFlag\Product; ?>
<?php use Config as Con; ?>

@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    <a class="btn btn-success btn-sm float-right" href="{{ route('product-create') }}"> Add Product</a>
    <h3>Manage Product</h3>
        @yield('response-message')
	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Category</th>
		      <th scope="col">Brand</th>
		      <th scope="col">Weight</th>
		      <th scope="col">Status</th>
		      <th scope="col">Description</th>
		      <th scope="col">Action</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$products -> isEmpty())
	  			@foreach($products as $key => $product)
	  				<tr>
	  					<td>{{ ++$key}}</td>
	  					<td>{{ $product -> name}}</td>
	  					<td>{{ $product -> category_id }}</td>
	  					<td>{{ $product -> brand_id }}</td>
	  					<td>{{ $product -> weight }}</td>
	  					<td>{{ $product -> status == Product::ACTIVE ? 'Active':'InActive' }}</td>
						<td>{{ $product -> description }}</td>
						<td>
							<a href="{{ route('product-update', ['id' => $product -> id]) }}" id="edit-{{ $product -> id }}">Edit</a> |
							<a href="">Delete</a> |
							<a href="{{ route('product-detail-view', ['id' => $product -> id]) }}" id="delete-{{ $product -> id }}">Details</a>
						</td>
	  				</tr>
	  			@endforeach
	  		@else 
                <tr>
                    <td class="text-center">No Records Found</td>
                </tr>
	  		@endif
	  	</tbody>
	</table>
	
	{{ $products -> links(Con::get('params.paginationTemplate')) }}
</main>

@endsection