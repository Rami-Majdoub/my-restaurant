<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductsController extends Controller
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
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('products.index')->with('products', $user->products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.form')->
            with('action_name', 'post')->
            with('action_route',
                'App\Http\Controllers\ProductsController@store'
            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required'
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->user_id = auth()->user()->id;
        $product->save();

        return redirect('/products')->with('success', 'Product Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if($product == null){
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id){
            return redirect('/products')->with('error', 'Unautherized');
        }

        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if($product == null){
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id){
            return redirect('/products')->with('error', 'Unautherized');
        }

        return view('products.form')->
            with('action_name', 'put')->
            with('action_route',
                ['App\Http\Controllers\ProductsController@update', $product->id])->
            with('product', $product);
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
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required'
        ]);

        $product = Product::find($id);

        if($product == null){
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id){
            return redirect('/products')->with('error', 'Unautherized');
        }
        
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect('/products')->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if($product == null){
            return redirect('/products')->with('error', 'Product Not Found');
        }

        if (auth()->user()->id !== $product->user_id){
            return redirect('/products')->with('error', 'Unautherized');
        }

        $product->delete();
        return redirect('/products')->with('success', 'Product Deleted');
    }
}
