<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use DataTables;

class StudentController extends Controller
{
    public function index(){
        return view('show');
    }

    public function getStudents(){
        $stutents = Student::all();

        return view('studentlist', compact('stutents'));
    }

    public function save(Request $request){
        if ($request->ajax()){
            // Create New student
            $stutent = new Student;
            $stutent->name = $request->input('name');
            $stutent->email = $request->input('email');
            // Save student
            $stutent->save();

            return response($stutent);
        }
    }

    public function delete(Request $request){
        if ($request->ajax()){
            Student::destroy($request->id);
        }
    }

    public function update(Request $request){
        if ($request->ajax()){
            $student = Student::find($request->id);
            $student->name = $request->input('name');
            $student->email = $request->input('email');

            $student->update();
            return response($student);
        }
    }
}
