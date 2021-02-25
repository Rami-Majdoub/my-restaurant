<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;
use App\Models\Table;

class TablesController extends Controller
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

        return view('tables.index')
            ->with('tables', $user->tables)
            ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.form')
            ->with('action_name', 'post')
            ->with('action_route', 'App\Http\Controllers\TablesController@store');
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
        ]);

        $table = new Table();
        $table->name = $request->input('name');
        $table->user_id = auth()->user()->id;
        $table->save();

        return redirect('/tables')->with('success', 'Table Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('tables.index')
          ->with('error', 'tables do not have page info!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Table::find($id);

        if($table == null){
            return redirect('/tables')->with('error', 'Table Not Found');
        }

        if (auth()->user()->id !== $table->user_id){
            return redirect('/tables')->with('error', 'Unautherized');
        }

        return view('tables.form')
            ->with('action_name', 'put')
            ->with('action_route',
                ['App\Http\Controllers\TablesController@update', $table->id])
            ->with('table', $table);
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
        ]);

        $table = Table::find($id);

        if($table == null){
            return redirect('/tables')->with('error', 'Table Not Found');
        }

        if (auth()->user()->id !== $table->user_id){
            return redirect('/tables')->with('error', 'Unautherized');
        }

        $table->name = $request->input('name');
        $table->save();

        return redirect('/tables')->with('success', 'Table Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        if($table == null){
            return redirect('/tables')->with('error', 'Table Not Found');
        }

        if (auth()->user()->id !== $table->user_id){
            return redirect('/tables')->with('error', 'Unautherized');
        }

        $table->delete();
        return redirect('/tables')->with('success', 'Table Deleted');
    }
}
