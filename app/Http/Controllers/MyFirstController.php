<?php

namespace App\Http\Controllers;

use App\Models\MyFirstModel;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; 

class MyFirstController extends Controller
{
    public function index(Request $request)
    {

        // $search = $request->Search;
        // //$data=MyFirstModel::paginate(5);

        // $data = MyFirstModel::where('name','LIKE','%'.$search.'%')
        //                     ->orwhere('last_name','LIKE','%'.$search.'%')   
        //                     ->paginate(7);

        $students = MyFirstModel::get();
        // dd($students);
        // return response()->json($students);
        return view('crud.index', ['students' => $students]);

        // $test = MyFirstModel::all();

        // $data = ['success'=>true,'test'=>$test];
        // return response()->json($data,200,[]);
    }

    public function getAllStudents(Request $request){
        return response()->json([
            "students"=>MyFirstModel::latest()->paginate(7),
        ]);
    }

    public function deleteSelectedStudents(Request $request){
        MyFirstModel::destroy($request->all());
        // dd($request->all());
    }

    public function create():view
    {
        return view('crud.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'last_name' => 'required'
        ]);

        MyFirstModel::create($request->all());

        // return redirect()->route('crud.index')->with('success','Estudiante agregado exitosamente');
    }

    public function show(MyFirstModel $myFirstModel)
    {
        //
    }

    public function edit($id)
    {

 
        $student = MyFirstModel::find($id);


        //dd($person);
        return view('crud.edit', ['student' => $student]);
    }

    public function update(Request $request, $id)
    {
        $student = MyFirstModel::find($id);

        $student->update($request->all());

        return response()->json($student);
        // return redirect()->route('crud.index')->with('success','Datos del estudiante: '.$person->name.' editados correctamente');
    }

    public function destroy($id)
    {
        //$myfirstmodel=MyFirstModel();
        // dd($id);
        $person = MyFirstModel::find($id);
        $person->delete();
        // return redirect()->route('crud.index');
    }
}
