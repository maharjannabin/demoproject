<?php use NepalFlag\Category; ?>

@extends('layouts.bootstrap4.main')
@section('content')
	<main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
	    <h2>Update Category</h2>
	    @if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif

		@if(Session::has('success') && !empty(Session::get('success')))
		    <div class="alert alert-success">
		        <ul>
		            <li>{{ Session::get('success')}}</li>
		        </ul>
		    </div>
		@endif

		{{ Form::open(['route' => ['category-update', 'id' => $category -> id], 'method' => 'POST']) }}
			<div class="form-group">
				{{ Form::label('name', 'Category Name') }}
				{{ Form::text('name', $category -> name, ['class' => 'form-control']) }}
				
			</div>

			<div class="form-group">
				{{ Form::label('parent_id', 'Parent Category') }}
				{{ Form::select('parent_id', Category::dropDownList(), $category -> parent_id, ['class' => 'form-control', 'placeholder' => 'Please choose category']) }}
			</div>

			<div class="form-group">
				{{ Form::label('order', 'Position') }}
				{{ Form::text('order', $category -> order, ['class' => 'form-control']) }}
			</div>

			<div class="form-group">
				<?php 
					$radioActive 	= false;
					$radioInactive 	= false;

					if($category -> is_disabled == Category::ACTIVE) 
						$radioActive 	= true;

					if($category -> is_disabled == Category::INACTIVE) 
						$radioInactive 	= true;
				?>

				{{ Form::label('is_disabled', 'Status')}} <br >
				Active: {{ Form::radio('is_disabled', Category::ACTIVE, $radioActive) }} 

				InActive: {{ Form::radio('is_disabled', Category::INACTIVE, $radioInactive) }}
			</div>
			<div class="form-group">
				{{ Form::label('description', 'Description') }}
				{{ Form::textArea('description', $category -> description, ['class' => 'form-control']) }}
			</div>


			{{ Form::submit('Submit', ['class' => 'btn btn-primary btn-sm'])}}
			<a href="{{ route('category-index') }}" class="btn btn-danger btn-sm">Cancel</>
		{{ Form::close() }}
	</main>
@endsection