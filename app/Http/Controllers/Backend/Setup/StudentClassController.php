<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use DB;

class StudentClassController extends Controller
{
    public function view(){     
        $data['allData'] = StudentClass::all();
        
        return view('backend.setup.student_class.view-class', $data);
    }

    public function add(){
    
        return view('backend.setup.student_class.add-class');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_classes,name',
        ]);
        //end data validation

        $data = new StudentClass();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.class.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = StudentClass::find($id);

        return view('backend.setup.student_class.add-class', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = StudentClass::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_classes,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.class.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $slider =  StudentClass::find($id);
        $slider->delete();

        return redirect()->route('setups.student.class.view')->with('success', 'Data deleted successfully');
    }
}
