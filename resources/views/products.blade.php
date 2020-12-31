@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <div class="col">
            <div class="card h-100">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"> Salade </h5>
                <h6 class="card-subtitle mb-2 text-muted">Price: 2.000 DNT</h6>
                <p class="card-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                </p>
            </div>
            <div class="card-footer">
                <a href="#" class="btn btn-primary"> UPDATE </a>
                <a href="#" class="btn btn-danger"> DELETE </a>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
