@extends('layouts.app')

@section('content')

<a href="/bills" class="btn btn-accent"> Go back </a>

<br>
<br>
<h3> Bill for table {{ $bill->table->name?? 'DELETED' }} ({{ $bill->is_paid == 1? 'Paid': 'Not Paid' }})</h3>

<div class="card text-center bg-light mb-3" style="max-width: 25rem;">
  <div class="card-header">{{ $bill->user->restaurant_name }}</div>
  <div class="card-body">
    <h5 class="card-title">{{ $bill->created_at }}</h5>

    <table class="mb-3 w-100">
      @foreach($bill->products as $product)
        <tr>
          <td align="left">{{$product->pivot->quantity}} {{ $product->name }}</td>
          <td align="left">$ {{$product->price * $product->pivot->quantity}}</td>
        </tr>
      @endforeach
    </table>
    <p class="card-text">Total: $ {{ $bill->total }}</p>
  </div>
</div>

<div>
  <a href="/bills/{{ $bill->id }}/edit" class="btn btn-white"> Edit </a>

  @if($bill->is_paid == 0)
    {!! Form::open(['action' => ['App\Http\Controllers\BillsController@mark_as_paid', $bill->id], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
    {{ Form::submit('Mark as paid', ['class' => 'btn btn-white']) }}
    {!! Form::close() !!}
  @endif

  {!! Form::open(['action' => ['App\Http\Controllers\BillsController@destroy', $bill->id], 'method' => 'POST', 'style' => 'display: inline-block']) !!}
  {{ Form::hidden('_method', 'DELETE') }}
  {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
  {!! Form::close() !!}
</div>

@endsection
