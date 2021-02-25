@extends('layouts.app')

@section('content')

<a href="/products" class="btn btn-accent"> Go back </a>
<hr>
@if($action_name == 'put')
  <h4> Edit product "{{ $product->name }}" </h4>
@else
  <h4> Create product </h4>
@endif
<hr>
{!! Form::open(['action' => $action_route]) !!}

  <div class="form-group">
    {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
    {{ Form::text('name', isset($product->name)? $product->name : '', ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::label('description', 'Description', ['class' => 'form-label']) }}
    {{ Form::textarea('description', isset($product->description)? $product->description: '', ['rows' => 5, 'class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::label('price', 'Price', ['class' => 'form-label']) }}
    {{ Form::number('price', isset($product->price)? $product->price: '', ['step' => 0.05, 'class' => 'form-control']) }}
  </div>

  <!-- we can only use POST or GET with the form -->
  @if($action_name == 'put')
    {{ Form::hidden('_method', 'PUT') }}
  @endif

  {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

@endsection
