@section('response-message')	
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
@endsection