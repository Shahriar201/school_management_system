<?php

namespace App\Http\Controllers\Backend;

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
use App\Model\StudentMarks;

class DefaultController extends Controller
{
    public function getStudent(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AssignStudent::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        return response()->json($allData);
    }
    
    public function getSubject(Request $request){
        $class_id = $request->class_id;
        $allData = AssignSubject::with(['subject'])->where('class_id', $class_id)->get();
        return response()->json($allData);
    }
}
