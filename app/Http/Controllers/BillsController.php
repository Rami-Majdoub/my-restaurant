<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\User;
use App\Models\Product;

class BillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = auth()->user()->bills()->get();
        return view('bills.index')->with('bills', $bills);
    }

    /**
    * Change the bill attribute is_paid to true.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function mark_as_paid(int $id)
    {
      $bill = Bill::find($id);
      $result = $this->manageErrors($bill);
      if($result) return $result;

      $bill->is_paid = 1;
      $bill->save();

      return redirect('/tables')->with('success', 'Bill Paid');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = auth()->user()->products()->pluck('name', 'id');
        $selected_products = [];

        return view('bills.form')->
            with('action_name', 'post')->
            with('action_route',
                'App\Http\Controllers\BillsController@store'
            )->
          with('products', $products)->
          with('user_tables', auth()->user()->tables()->pluck('name', 'id'))->
          with('selected_products', $selected_products);
    }

    /**
    * verify required fields
    */
    private function validateFields(Request $request)
    {
        $this->validate($request, [
            'is_paid' => 'required',
            'table_id' => 'required'
        ]);
    }

    private function findProductId($id, $products)
    {
      $i = 0;
      $nbProduct = count($products);
      while($i < $nbProduct && $products[$i]->id != $id) $i++;

      if ($i < $nbProduct && $products[$i]->id == $id) {
        return $products[$i];
      }
      return null;
    }

    private function setBillFromRequest(Request $request, Bill $bill)
    {
        // save the bill to create the id field
        // after you specify the required values
        $bill->is_paid = $request->input('is_paid');
        $bill->table_id = $request->input('table_id');
        $bill->user_id = auth()->user()->id;
        $bill->total = 0;
        $bill->save();

        // get the selected products
        $selected_products_ids = $request->input('bill_product_list');
        $selected_products_qantitys = $request->input('bill_product_quantity');

        if($selected_products_ids == null) $selected_products_ids = [];
        if($selected_products_qantitys == null) $selected_products_qantitys = [];

        // optimization to calculate the bill Price from the products ids
        $user_products = auth()->user()->products()->get();

        // couldn't sync (Field 'quantity' doesn't have a default value)
        // So...
        $bill->products()->detach();

        // calculate the bill total
        $sum = 0;
        $nbProduct = count($selected_products_ids);

        for ($i = 0; $i < $nbProduct; $i++) {
          $product_id = $selected_products_ids[$i];
          $qte = $selected_products_qantitys[$i];
          if ($qte > 0) {
              $bill->products()->attach($product_id, ['quantity' => $qte]);
              $sum += $qte * $this->findProductId($product_id, $user_products)->price;
          }
        }
        $bill->total = $sum;
        return $bill;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateFields($request);

        $selected_products_ids = $request->input('bill_product_list');
        if ($selected_products_ids == null){
            return redirect('/bills')->
            with('error', 'Bill Not Created: Bill did not contain any products');
        }

        $bill = new Bill();
        $this->setBillFromRequest($request, $bill);
        $bill->save();

        return redirect('/bills')->with('success', 'Bill Created');
    }

    private function manageErrors($bill)
    {
        if($bill == null){
            return redirect('/bills')->with('error', 'Bill Not Found');
        }

        if (auth()->user()->id !== $bill->user_id){
            return redirect('/bills')->with('error', 'Unautherized');
        }

        return null;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Bill::find($id);
        $result = $this->manageErrors($bill);
        if($result) return $result;

        return view('bills.show')->with('bill', $bill);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);
        $result = $this->manageErrors($bill);
        if($result) return $result;

        // lists is deprecated: pluck
        $products = auth()->user()->products()->pluck('name', 'id');
        $selected_products = $bill->products()->get();

        return view('bills.form')->
            with('action_name', 'put')->
            with('action_route',
                ['App\Http\Controllers\BillsController@update', $bill->id])->
          with('bill', $bill)->
          with('products', $products)->
          with('user_tables', auth()->user()->tables()->pluck('name', 'id'))->
          with('selected_products', $selected_products);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validateFields($request);

      $bill = Bill::find($id);
      $result = $this->manageErrors($bill);
      if($result) return $result;

      $this->setBillFromRequest($request, $bill);
      $bill->save();

      return redirect('/bills')->with('success', 'Bill Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $bill = Bill::find($id);
      $result = $this->manageErrors($bill);
      if($result) return $result;

      // delete the rows from bill_product table
      $bill->products()->detach();
      $bill->delete();

      return redirect('/bills')->with('success', 'Bill Deleted');
    }
}
