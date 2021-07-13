<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignSubject;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\AssignStudent;
use App\Model\Year;
use DB;
use PDF;

class StudentRollController extends Controller
{
    public function view(){  
        $data['years'] = Year::orderBy('id','desc')->get();
        $data['classes'] = StudentClass::all();
        
        return view('backend.student.roll_generate.view-roll-generate', $data);
    }

    public function getStudent(Request $request){
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        
        return response()->json($allData);
    }

    public function store(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($request->student_id != null){
            for($i=0; $i < count($request->student_id); $i++){
                AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id
                [$i])->update(['roll'=> $request->roll[$i]]);
            }
        }else{
            return redirect()->back()->with('error', 'Sorry! There are no student');
        }
        return redirect()->route('students.roll.view')->with('success', 'Roll generated Successfully');
    }
}
