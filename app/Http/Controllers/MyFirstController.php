<?php

namespace App\Http\Controllers;

use App\Models\MyFirstModel;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; 
use Illuminate\Support\Facades\DB;

class MyFirstController extends Controller
{
    public function index(Request $request){

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
    public function create(){
        return view('crud.create');
    }
    public function store(Request $request){
        try {
            $db = DB::transaction(function () use($request){
                return MyFirstModel::create($request->all());
            });
            // dd($db->id);
            return response()->json([
                'success'=>'Estudiante creado exitosamnete!'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error'=> $exception->getMessage()
            ]);
        }
    }
    public function show(MyFirstModel $myFirstModel){
        //
    }
    public function edit($id){
        $student = MyFirstModel::find($id);


        //dd($person);
        return view('crud.edit', ['student' => $student]);
    }
    public function update(Request $request, $id){
        try {
            DB::transaction(function() use($request, $id){
                $student = MyFirstModel::find($id);
                $student->update($request->all());
            });
            return response()->json([
                'success'=>'Estudiante editado exitosamnete!'
            ]);
        } catch (Exception $exception) {

            return response()->json([
                'error'=> $exception->getMessage()
            ]);
        }
        // return redirect()->route('crud.index')->with('success','Datos del estudiante: '.$person->name.' editados correctamente');
    }
    public function destroy($id){
        try {
            DB::transaction(function() use($id){
                $person = MyFirstModel::find($id);
                $person->delete();
            });
            return response()->json([
                'success'=>'Estudiante eliminado exitosamnete!'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error'=> $exception->getMessage()
            ]);
        }
        
        //$myfirstmodel=MyFirstModel();
        // return redirect()->route('crud.index');
    }
    public function deleteSelectedStudents(Request $request){
        try {
            DB::transaction(function () use($request){
                MyFirstModel::destroy($request->all());
            });
            return response()->json([
                'success'=>'Los estudiante fueron eliminados exitosamnete!'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'error'=> $exception->getMessage()
            ]);
        }
    }
}
