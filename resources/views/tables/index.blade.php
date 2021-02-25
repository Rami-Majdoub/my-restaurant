@extends('layouts.app')

@section('content')

<a href="/tables/create" class="btn btn-primary float-right">Create table</a>
<h3>Tables</h3>
<hr>

@if(count($tables) > 0)
	<div class="row row-cols-2 row-cols-md-3 g-4">
		@foreach($tables as $table)
			<div class="col mb-3">
				<div class="card h-100">
					<!-- <img src="..." class="card-img-top" alt="..."> -->
					<div class="card-body">
						<h5 class="card-title">Table: {{ $table->name }}</h5>
						<h5 class="card-subtitle">{{ count($table->unpaidBills) }} unpaid bills</h5>
						@foreach($table->unpaidBills as $bill)
							Total: $ {{ $bill->total}}
							<a href="bills/{{$bill->id}}">See Bill</a>
							<br>
						@endforeach
					</div>
					<div class="card-footer">
            <a href="/tables/{{ $table->id }}/edit" class="btn btn-white"> Edit </a>
						{!! Form::open(['action' => ['App\Http\Controllers\TablesController@destroy', $table->id], 'method' => 'POST', 'class' => 'float-right']) !!}
							{{ Form::hidden('_method', 'DELETE') }}
							{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
						{!! Form::close() !!}
          </div>
				</div>
			</div>
		@endforeach
	</div>
@else
    <h3> No tables </h3>
@endif

@endsection
