@extends('layouts.app')

@section('content')

<a href="/products" class="btn btn-accent"> Go back </a>
<hr>

<h5> {{ $product->name }} </h5>
<p> {{ $product->description }} </p>

@endsection
