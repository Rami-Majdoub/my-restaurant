@extends('layouts.app')

@section('content')

<a href="/products" class="btn btn-primary"> Go back </a>
<hr>
<h4> Creating a new product </h4>
<hr>
{!! Form::open(['action' => 'App\Http\Controllers\ProductsController@store']) !!}

  <div class="form-group">
    {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
    {{ Form::text('name', '', ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    {{ Form::label('description', 'Description', ['class' => 'form-label']) }}
    {{ Form::textarea('description', '', ['class' => 'form-control']) }}
  </div>
  
  <div class="form-group">
    {{ Form::label('price', 'Price', ['class' => 'form-label']) }}
    {{ Form::number('price', '', ['class' => 'form-control']) }}
  </div>

  {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

@endsection