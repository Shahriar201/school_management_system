<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Designation;
use DB;

class DesignationController extends Controller
{
    public function view(){    
        $data['allData'] = Designation::all();
        
        return view('backend.setup.designation.view-designation', $data);
    }

    public function add(){
    
        return view('backend.setup.designation.add-designation');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:designations,name',
        ]);
        //end data validation

        $data = new Designation();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.designation.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = Designation::find($id);

        return view('backend.setup.designation.add-designation', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = Designation::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:designations,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.designation.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $designation =  Designation::find($id);
        $designation->delete();

        return redirect()->route('setups.designation.view')->with('success', 'Data deleted successfully');
    }
}
