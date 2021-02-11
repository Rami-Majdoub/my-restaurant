@extends('layouts.app')

@section('content')

<a href="/bills" class="btn btn-secondary"> Go back </a>

<br>
<br>
<h3> Bill of table 1 ({{ $bill->is_paid == 1? 'Paid': 'Not Paid' }})</h3>

<div class="card text-center text-dark bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header">{{ $bill->user->restaurant_name }}</div>
  <div class="card-body">
    <h5 class="card-title">{{ $bill->created_at }}</h5>

    <table class="mb-3 w-100">
      @foreach($bill->products as $product)
        <tr>
          <td>{{$product->pivot->quantity}} {{ $product->name }}</td>
          <td>$ {{$product->price * $product->pivot->quantity}}</td>
        </tr>
      @endforeach
    </table>
    <p class="card-text">Total: $ {{ $bill->total }}</p>
  </div>
</div>

@endsection
