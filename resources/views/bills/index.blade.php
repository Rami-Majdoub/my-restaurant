@extends('layouts.app')

@section('content')

<a href="/bills/create" class="btn btn-primary float-right">Create bill</a>
<h3>Bills</h3>
<hr>

@if(count($bills) > 0)
	<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
		@foreach($bills as $bill)
			<div class="col mb-3">
				<div class="card h-100">
					<!-- <img src="..." class="card-img-top" alt="..."> -->
					<div class="card-body">
						<h5 class="card-title">Table: {{ $bill->table->name?? 'DELETED' }} ({{ $bill->is_paid == 0? 'Not Paid': 'Paid' }})</h5>
						<h6 class="card-subtitle mb-2 text-muted">Total: ${{ $bill->total }}</h6>
						<p class="card-text">
							<a href="/bills/{{ $bill->id }}"> See Bill </a>
						</p>
					</div>
					<div class="card-footer">
            <a href="/bills/{{ $bill->id }}/edit" class="btn btn-white"> Edit </a>
						{!! Form::open(['action' => ['App\Http\Controllers\BillsController@destroy', $bill->id], 'method' => 'POST', 'class' => 'float-right']) !!}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
						{!! Form::close() !!}
          </div>
				</div>
			</div>
		@endforeach
	</div>
@else
    <h3> No bills </h3>
@endif

@endsection
