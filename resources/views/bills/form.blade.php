@extends('layouts.app')

@section('content')

<a href="/bills" class="btn btn-secondary"> Go back </a>
<hr>
<h4> Modifying bill </h4>
<hr>
{!! Form::open(['action' => $action_route]) !!}

  <div class="form-group">
    {{ Form::label('is_paid', 'Is Paid', ['class' => 'form-label']) }}
    {{ Form::select('is_paid', array('0' => 'No', '1' => 'Yes'), $bill->is_paid ?? 0, ['class' => 'form-control']) }}
  </div>

  <div class="form-group">
    <table class="w-100" id="products_table">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
      </tr>
      @foreach($selected_products as $product)
        <tr>
          <td>
            {!! Form::hidden('bill_product_list[]', $product->id) !!}
            {!! Form::label('bill_product_list[]', $product->name) !!}
          </td>
          <td>
            {!! Form::number('bill_product_quantity[]', $product->pivot->quantity, ['min' => 0, 'class' => 'form-control']) !!}
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  <hr>

  <div class="form-group">
    {!! Form::label('selectedProduct', 'Add More Products:', ['class' => 'form-label']) !!}
    <div class="row">
      <div class="col-10">
        {!! Form::select('products', $products, '', ['id' => 'selectedProduct','class' => 'form-control']) !!}
      </div>
      <div class="col-1">
        {!! Form::Button('Add', ['id' => 'addItem', 'class' => 'addItem btn btn-secondary', 'onClick' => 'addRow()']) !!}
      </div>
    </div>
  </div>

  <!-- we can only use POST or GET with the form -->
  @if($action_name == 'put')
    {{ Form::hidden('_method', 'PUT') }}
  @endif

  {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
{!! Form::close() !!}

<script type="text/javascript">
function addRow() {
  const selectedProduct = $('#selectedProduct')[0];
  const selectedOption = selectedProduct.selectedOptions[0];

  const name = selectedOption.label;
  const id = selectedOption.value;
  const row = `
  <tr>
    <td>
      {!! Form::hidden('bill_product_list[]','${id}') !!}
      {!! Form::label('bill_product_list[]', '${name}', ['class' => 'col-auto']) !!}
    </td>
    <td>
      {!! Form::number('bill_product_quantity[]', '0', ['min' => 0, 'class' => 'form-control col-auto']) !!}
    </td>
  </tr>
  `;
  $("#products_table").append(row);
}
</script>
@endsection
