<?php

namespace App\Http\Controllers\Backend\Marks;

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
use App\Model\ExamType;
use DB;
use PDF;
use App\Model\StudentMarks;
use App\Model\MarksGrade;

class GradeController extends Controller
{
    public function view(){
        $data['allData'] = MarksGrade::all();
        return view('backend.marks.view-grade-marks', $data);
    }
    
    public function add(){     
        return view('backend.marks.add-grade-marks');
    }

    public function store(Request $request){
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->route('marks.grade.view')->with('success', 'Data inserted Successfully!');
    }

    public function edit($id){
        $data['editData'] = MarksGrade::find($id);
        return view('backend.marks.add-grade-marks', $data);
    }

    public function update(Request $request, $id){
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        return redirect()->route('marks.grade.view')->with('success', 'Data updated Successfully!');
    }
}
