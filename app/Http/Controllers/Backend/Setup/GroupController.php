<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentGroup;
use DB;

class GroupController extends Controller
{
    public function view(){     
        $data['allData'] = StudentGroup::all();
        
        return view('backend.setup.group.view-group', $data);
    }

    public function add(){
    
        return view('backend.setup.group.add-group');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_groups,name',
        ]);
        //end data validation

        $data = new StudentGroup();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.group.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = StudentGroup::find($id);

        return view('backend.setup.group.add-group', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = StudentGroup::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:student_groups,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.group.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $year =  StudentGroup::find($id);
        $year->delete();

        return redirect()->route('setups.student.group.view')->with('success', 'Data deleted successfully');
    }
}
