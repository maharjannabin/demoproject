
@section('left-side-nav')
<nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
	<ul class="nav nav-pills flex-column">
        <li class="nav-item"><a class="nav-link active" href="{{ url('product') }}" id="nav-link-product">Product</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ url('category') }}">Category</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ url('brand') }}">Brands</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ url('product-size') }}">Product Size</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ url('product-detail') }}">Product Detail</a></li>
		<li class="nav-item"><a class="nav-link" href="{{ url('sales') }}">Sales</a></li>
	</ul>
</nav>
@endsection