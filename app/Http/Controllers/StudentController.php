<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        return view('student.index',compact('students'));
    }

    public function create(){
        return view('student.create');
    }

    public function store(StudentRequest $request){
        //$all_data = $request->all();
        //dd($all_data);

        //1st way without custom Request
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:students',
//            'phone' => 'required|unique:students',
//            'image' => 'required'
//        ]);
        //Form::create($request->all());
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->image = 'demo_image';
        $student->save();



        //2nd way without custom Request
//        $validatedData = $request->validate([
//            'name' => 'required',
//            'email' => 'required|email|unique:students',
//            'phone' => 'required|unique:students',
//            'image' => 'required'
//        ], [
//            'name.required' => 'Name is required',
//            'email.required' => 'Email have to unique',
//            'phone.required' => 'Phone have to unique',
//            'image.required' => 'Image is required'
//        ]);
//
//        Student::create($validatedData);






        return redirect()->to('student/index');;
    }

    public function edit($id){
        //dd($id);
        $student = Student::findOrFail($id);
        return view('student.edit',compact('student'));
    }

    public function update(StudentRequest $request,$id){

        //dd($request->all());
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:students',
//            'phone' => 'required|unique:students',
//            'image' => 'required'
//        ]);
//        dd($request->all());



        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->image = 'update_image';
        $student->save();
        //return Route::redirect('student/index');
        return redirect()->to('student/index');

    }

    public function delete($id){
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->to('student/index');
    }
}
