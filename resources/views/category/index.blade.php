<?php use NepalFlag\Category; ?>
<?php use Config as Con; ?>


@extends('layouts.bootstrap4.main')
@include('message')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    <a class="btn btn-success btn-sm float-right" href="{{ route('category-add') }}"> Add Category</a>
    <h2>Manage Categories</h2>
        @yield('response-message')
	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      	<th scope="col">#</th>
		      	<th scope="col">Name</th>
		      	<th scope="col">Description</th>
		      	<th scope="col">Image</th>
		      	<th scope="col">Parent Category</th>
		      	<th scope="col">Status</th>
		      	<th scope="col">Action</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$categories -> isEmpty())
	  			@foreach($categories as $key => $category)
	  				<tr>
	  					<td>{{ ++$key}}</td>
	  					<td>{{ $category -> name}}</td>
	  					<td>{{ $category -> description }}</td>
	  					<td>{{ $category -> image }}</td>
						<td>{{ $category -> parent_id}}</td>
						<td>{{ ($category -> is_disabled == Category::ACTIVE ) ? 'Active':'Inactive'}}</td>
						<td>
							<a href="{{ route('category-update', ['id' => $category -> id]) }}" id="edit-{{ $category -> id }}">Edit</a> | 
							<a href="{{ route('category-delete', ['id' => $category -> id]) }}" id="delete-{{ $category -> id }}">Delete</a>
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
	{{ $categories -> links(Con::get('params.paginationTemplate')) }}
</main>
@endsection