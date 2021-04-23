<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentShift;
use DB;

class ShiftController extends Controller
{
    public function view(){     
        $data['allData'] = StudentShift::all();
        
        return view('backend.setup.shift.view-shift', $data);
    }

    public function add(){
    
        return view('backend.setup.shift.add-shift');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_shifts,name',
        ]);
        //end data validation

        $data = new StudentShift();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.shift.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = StudentShift::find($id);

        return view('backend.setup.shift.add-shift', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = StudentShift::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_shifts,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.shift.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $shift =  StudentShift::find($id);
        $shift->delete();

        return redirect()->route('setups.student.shift.view')->with('success', 'Data deleted successfully');
    }
}
