<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; 
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{ 

    public function cards(Request $request){
        return view('crud.cards');
    }
    
    public function index(Request $request){

        $data = DB::table('genders')
                ->join('students', 'genders.id', '=', 'students.gender_id') 
                ->select('genders.*','students.last_name')
                ->get();

        return view('crud.index');

        // dd($data);

        // $search = $request->Search;
        // //$data=Student::paginate(5);

        // $data = Student::where('name','LIKE','%'.$search.'%')
        //                     ->orwhere('last_name','LIKE','%'.$search.'%')   
        //                     ->paginate(7);

        // $students = Student::get();
        // dd($students);
        // return response()->json($students);

        // $test = Student::all();

        // $data = ['success'=>true,'test'=>$test];
        // return response()->json($data,200,[]);
    }
    public function getAllStudents(Request $request){
        return response()->json([
            "students"=>Student::latest()->paginate(9),
        ]);
    }
    public function create(){
        return view('crud.create');
    }
    public function store(Request $request){
        try {
            DB::transaction(function () use($request){
                return Student::create($request->all());
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
    public function show(Student $Student){
        //
    }
    public function edit($id){
        $student = Student::find($id);


        //dd($person);
        return view('crud.edit', ['student' => $student]);
    }
    public function update(Request $request, $id){
        try {
            DB::transaction(function() use($request, $id){
                $student = Student::find($id);
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
                $person = Student::find($id);
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
        
        //$Student=Student();
        // return redirect()->route('crud.index');
    }
    public function deleteSelectedStudents(Request $request){
        try {
            DB::transaction(function () use($request){
                Student::destroy($request->all());
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
