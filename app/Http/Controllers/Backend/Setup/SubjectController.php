<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Subject;
use DB;

class SubjectController extends Controller
{
    public function view(){     
        $data['allData'] = Subject::all();
        
        return view('backend.setup.subject.view-subject', $data);
    }

    public function add(){
    
        return view('backend.setup.subject.add-subject');
    }

    public function store(Request $request){
        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:subjects,name',
        ]);
        //end data validation

        $data = new Subject();

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.subject.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = Subject::find($id);

        return view('backend.setup.subject.add-subject', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = Subject::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:subjects,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.subject.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $subject =  Subject::find($id);
        $subject->delete();

        return redirect()->route('setups.subject.view')->with('success', 'Data deleted successfully');
    }
}
