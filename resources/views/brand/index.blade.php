<?php use NepalFlag\Brand; ?>
<?php use Config as Con; ?>
@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    <a class="btn btn-success btn-sm float-right" href="{{ route('brand-add') }}"> Add Brand</a>
    <h2>Manage Brands</h2>
    
    @yield('response-message')

	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      	<th scope="col">#</th>
		      	<th scope="col">Name</th>
		      	<th scope="col">Description</th>
		      	<th scope="col">Logo</th>
		      	<th scope="col">Active</th>
		      	<th scope="col">Action</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$brands -> isEmpty())
	  			@foreach($brands as $key => $brand)
	  				<tr>
	  					<td>{{ ++$key}}</td>
	  					<td>{{ $brand -> name}}</td>
	  					<td>{{ $brand -> description }}</td>
	  					<td>{{ $brand -> logo }}</td>
						<td>{{ ($brand -> is_disabled == Brand::ACTIVE ) ? 'Active':'Inactive'}}</td>
						<td>
							<a href="{{ route('brand-update', ['id' => $brand -> id]) }}">Edit</a> | 
							<a href="{{ route('brand-delete', ['id' => $brand -> id]) }}">Delete</a>
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
	{{ $brands -> links(Con::get('params.paginationTemplate')) }}
</main>
@endsection