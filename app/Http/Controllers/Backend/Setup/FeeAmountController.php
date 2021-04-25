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
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        
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

    public function edit($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        // dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['student_classes'] = StudentClass::all();

        return view('backend.setup.fee_amount.edit-fee-amount', $data);
    }

    public function update(Request $request, $fee_category_id){
        if($request->class_id == NULL){
            return redirect()->back()->with('error', 'Sorry! you do not select any item');
        }else{
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();

            $countClass = count($request->class_id);
    
            for($i = 0; $i < $countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
    
        }
        return redirect()->route('setups.fee.amount.view')->with('success', 'Data updated successfully');
    }

    public function details($fee_category_id){
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        // dd($data['editData']->toArray());
        return view('backend.setup.fee_amount.details-fee-amount', $data);
    }

    public function delete($id){
        $fee =  FeeCategory::find($id);
        $fee->delete();

        return redirect()->route('setups.fee.category.view')->with('success', 'Data deleted successfully');
    }
}
