@extends('layouts.app')

@section('content')

<a href="/products" class="btn btn-accent"> Go back </a>
<hr>

<h5> {{ $product->name }} </h5>
<h6> $ {{ $product->price }} </h6>
<p> {!! $product->description !!} </p>

@endsection
