@extends('layouts.app')

@section('content')

<a href="/products" class="btn btn-primary"> Go back </a>
<hr>
<h4> Modifying product {{ $product->name }} </h4>
<hr>
{!! Form::open(['action' => ['App\Http\Controllers\ProductsController@update', $product->id]]) !!}

  <div class="form-group">
    {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
    {{ Form::text('name', $product->name, ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::label('description', 'Description', ['class' => 'form-label']) }}
    {{ Form::textarea('description', $product->description, ['class' => 'form-control']) }}
  </div>
  
  <div class="form-group">
    {{ Form::label('price', 'Price', ['class' => 'form-label']) }}
    {{ Form::number('price', $product->price, ['class' => 'form-control']) }}
  </div>

  <!-- we can only use POST or GET with the form -->
  {{ Form::hidden('_method', 'PUT') }}

  {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

@endsection