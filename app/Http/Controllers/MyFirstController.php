<?php

namespace App\Http\Controllers;

use App\Models\MyFirstModel;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; 

class MyFirstController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->Search;
        //$data=MyFirstModel::paginate(5);

        $data = MyFirstModel::where('name','LIKE','%'.$search.'%')
                            ->orwhere('last_name','LIKE','%'.$search.'%')   
                            ->paginate(10);

                            
        return view('crud.index', ['test' => $data, 'search' => $search]);

        // $test = MyFirstModel::all();

        // $data = ['success'=>true,'test'=>$test];
        // return response()->json($data,200,[]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():view
    {
        return view('crud.create');
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required'
        ]);

        MyFirstModel::create($request->all());

        return redirect()->route('crud.index')->with('success','Estudiante agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MyFirstModel  $myFirstModel
     * @return \Illuminate\Http\Response
     */
    public function show(MyFirstModel $myFirstModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MyFirstModel  $myFirstModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $myFirstModel = MyFirstModel::all();
 
        $person = $myFirstModel->find($id);

        //dd($person);
        return view('crud.edit', ['test' => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MyFirstModel  $myFirstModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $myFirstModel = MyFirstModel::all();

        $person = $myFirstModel->find($id);

        $person->update($request->all());
        return redirect()->route('crud.index')->with('success','Datos del estudiante: '.$person->name.' editados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MyFirstModel  $myFirstModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $myFirstModel = MyFirstModel::all();
 
        $person = $myFirstModel->find($id);

        //$myfirstmodel=MyFirstModel();
        //dd($person);

        $person->delete();
        return redirect()->route('crud.index');
    }
}
