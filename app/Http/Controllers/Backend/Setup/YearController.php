<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Year;
use DB;

class YearController extends Controller
{
    public function view(){     
        $data['allData'] = Year::all();
        
        return view('backend.setup.year.view-year', $data);
    }

    public function add(){
    
        return view('backend.setup.year.add-year');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:years,name',
        ]);
        //end data validation

        $data = new Year();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.year.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = Year::find($id);

        return view('backend.setup.year.add-year', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = Year::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:years,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.student.year.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $year =  Year::find($id);
        $year->delete();

        return redirect()->route('setups.student.year.view')->with('success', 'Data deleted successfully');
    }
}
