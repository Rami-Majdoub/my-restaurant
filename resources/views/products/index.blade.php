@extends('layouts.app')

@section('content')

<a href="/products/create" class="btn btn-primary">Create a new product</a>
<hr>

@if(count($products) > 0)
	<div class="row row-cols-1 row-cols-md-3 g-4">
		@foreach($products as $product)
			<div class="col">
				<div class="card h-100">
					<!-- <img src="..." class="card-img-top" alt="..."> -->
					<div class="card-body">
						<h5 class="card-title">{{ $product->name }}</h5>
						<h6 class="card-subtitle mb-2 text-muted"> Price: TND {{ $product->price }}</h6>
						<p class="card-text">{{ $product->description }}</p>
						<a href="/products/{{ $product->id }}"> Read more </a>
					</div>
					<div class="card-footer">
            <a href="/products/{{ $product->id }}/edit" class="btn btn-dark"> update </a>
						
						{!! Form::open(['action' => ['App\Http\Controllers\ProductsController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right']) !!}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('delete', ['class' => 'btn btn-danger']) }}
						{!! Form::close() !!}
          </div>
				</div>
			</div>
		@endforeach
	</div>
@else
    <h3> No products </h3>
@endif

@endsection