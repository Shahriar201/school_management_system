<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\ExamType;
use DB;

class ExamTypeController extends Controller
{
    public function view(){     
        $data['allData'] = ExamType::all();
        
        return view('backend.setup.exam_type.view-exam-type', $data);
    }

    public function add(){
    
        return view('backend.setup.exam_type.add-exam-type');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:exam_types,name',
        ]);
        //end data validation

        $data = new ExamType();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.exam.type.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = ExamType::find($id);

        return view('backend.setup.exam_type.add-exam-type', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = ExamType::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:exam_types,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.exam.type.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $exam_type =  ExamType::find($id);
        $exam_type->delete();

        return redirect()->route('setups.exam.type.view')->with('success', 'Data deleted successfully');
    }
}
