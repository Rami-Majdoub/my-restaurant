@extends('layouts.app')

@section('content')

<a href="/tables" class="btn btn-accent"> Go back </a>
<hr>
@if($action_name == 'put')
  <h4> Edit table "{{ $table->name }}" </h4>
@else
  <h4> Create table </h4>
@endif
<hr>
{!! Form::open(['action' => $action_route]) !!}

  <div class="form-group">
    {{ Form::label('name', 'Name', ['class' => 'form-label']) }}
    {{ Form::text('name', isset($table->name)? $table->name : '', ['class' => 'form-control']) }}
  </div>

  <!-- we can only use POST or GET with the form -->
  @if($action_name == 'put')
    {{ Form::hidden('_method', 'PUT') }}
  @endif

  {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

@endsection
