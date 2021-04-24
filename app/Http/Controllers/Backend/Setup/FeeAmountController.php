<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use DB;

class FeeAmountController extends Controller
{
    public function view(){    
        $data['allData'] = FeeCategoryAmount::all();
        
        return view('backend.setup.fee_amount.view-fee-amount', $data);
    }

    public function add(){
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();
    
        return view('backend.setup.fee_amount.add-fee-amount', $data);
    }

    public function store(Request $request){
        $countClass = count($request->class_id);
        if($countClass !=NULL){
            for($i = 0; $i < $countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }

        return redirect()->route('setups.fee.amount.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $editData = FeeCategory::find($id);

        return view('backend.setup.fee_category.add-fee-category', compact('editData'));
    }

    public function update(Request $request, $id){
        $data = FeeCategory::find($id);

        // data validation
        $this->validate($request,[
            'name'=> 'required|unique:fee_categories,name,'.$data->id
        ]);
        //end data validation

        $data->name = $request->name;
        $data->save();

        return redirect()->route('setups.fee.category.view')->with('success', 'Data updated successfully');

    }

    public function delete($id){
        $fee =  FeeCategory::find($id);
        $fee->delete();

        return redirect()->route('setups.fee.category.view')->with('success', 'Data deleted successfully');
    }
}
