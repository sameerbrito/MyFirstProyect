<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Classroom;

class ClassroomController extends Controller
{

    public function getTeacheInClassroom(){
        return response()->json([
            "classroom"=>Classroom::with('teacher')->get(),
        ]);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
