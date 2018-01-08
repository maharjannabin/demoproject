<?php use NepalFlag\ProductSize; ?>

@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    <a class="btn btn-success btn-sm float-right" href="{{ route('product-size-add') }}"> Add Product Size</a>
    <h2>Manage Product Size</h2>
    
    @yield('response-message')

	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      	<th scope="col">#</th>
		      	<th scope="col">Name</th>
		      	<th scope="col">Description</th>
		      	<th scope="col">Active</th>
		      	<th scope="col">Action</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$sizes -> isEmpty())
	  			@foreach($sizes as $key => $size)
	  				<tr>
	  					<td>{{ ++$key}}</td>
	  					<td>{{ $size -> name}}</td>
	  					<td>{{ $size -> description }}</td>
						<td>{{ ($size -> is_disabled == ProductSize::ACTIVE ) ? 'Active':'Inactive'}}</td>
						<td>
							<a href="{{ route('product-size-update', ['id' => $size -> id]) }}">Edit</a> | 
							<a href="{{ route('product-size-delete', ['id' => $size -> id]) }}">Delete</a>
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
</main>
@endsection