<?php  use NepalFlag\Product; ?>
<?php use Config as Con; ?>

@extends('layouts.bootstrap4.main')
@section('content')
<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	
    <a class="btn btn-success btn-sm float-right" href="{{ route('sales-add') }}"> Add Sales</a>
    <h3>Manage Sales</h3>
    
	<table class="table table-bordered">
	  	<thead>
	    	<tr>
		      <th scope="col">#</th>
		      <th scope="col">Product</th>
		      <th scope="col">Discount</th>
		      <th scope="col">Service Charge</th>
		      <th scope="col">Tax</th>
		      <th scope="col">Quantity</th>
		      <th scope="col">Sub Total</th>
		      <th scope="col">Grand Total</th>
		      <th scope="col">Note</th>
		      <th scope="col">Order By</th>
		      <th scope="col">Status</th>
	    	</tr>
	  	</thead>
	  	<tbody>
	  		@if (!$orders -> isEmpty())
	  			@foreach($orders as $key => $order)
	  				<tr>
	  					<td>{{ ++$key}}</td>
	  					<td>{{ $order -> productDetail -> product -> name}}</td>
	  					<td>{{ $order -> discount }}</td>
	  					<td>{{ $order -> service_charge }}</td>
	  					<td>{{ $order -> tax }}</td>
	  					<td>{{ $order -> quantity }}</td>
	  					<td>{{ $order -> sub_total }}</td>
	  					<td>{{ $order -> grand_total }}</td>
	  					<td>{{ $order -> note }}</td>
	  					<td>{{ $order -> order_by }}</td>
	  					<td>{{ $order -> status}}</td>
	  					
						<td>
							<a href="{{ route('sales-update', ['id' => $order -> id]) }}">Edit</a> |
							<a href="">Delete</a> 
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
	
	{{ $orders -> links(Con::get('params.paginationTemplate')) }}
</main>

@endsection