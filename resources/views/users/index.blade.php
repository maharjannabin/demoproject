@extends('layouts.bootstrap4.main')
@section('content')
	<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
		<div class="row">
	        <div class="col-lg-12 margin-tb">
	            <div class="pull-left">
	                <h2>Manage Users</h2>
	            </div>
	            <div class="pull-right">
	                <a class="btn btn-success" href="{{ route('users.create') }}"> Add User</a>
	            </div>
	        </div>
    	</div>
	    
	    <table class="table table-bordered">
	        <tr>
	            <th>ID#</th>
	            <th>Name</th>
	            <th>Email</th>
	            <th width="280px">Operation</th>
	        </tr>
	    @foreach ($users as $user)
	    <tr>
	        <td>{{ $user -> id }}</td>
	        <td>{{ $user -> username }}</td>
	        <td>{{ $user -> email }}</td>
	        <td>
	            <a class="btn btn-info" href="{{ route('users.show', $user -> id) }}">Show</a>
	            <a class="btn btn-primary" href="{{ route('users.edit',$user -> id) }}">Edit</a>
	            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user -> id],'style'=>'display:inline']) !!}
	            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	            {!! Form::close() !!}
	        </td>
	    </tr>
	    @endforeach
	    </table>
	    
	</main>
@endsection
