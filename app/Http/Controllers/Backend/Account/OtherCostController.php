<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountOtherCost;

class OtherCostController extends Controller
{
    public function view(){
        $data['allData'] = AccountOtherCost::all();

        return view('backend.account.cost.view-cost', $data);
    }

    public function add(){
        return view('backend.account.cost.add-cost');
    }

    public function store(Request $request){
        $cost = new AccountOtherCost();
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        if($request->file('image')){
            $file = $request->file('image');
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $fileName);
            $cost['image'] = $fileName;
        }
        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('accounts.cost.view')->with('success', 'Data inserted successfully');
    }

    public function edit($id){
        $data['editData'] = AccountOtherCost::find($id);

        return view('backend.account.cost.add-cost', $data);
    }
    
    public function update(Request $request, $id){
        $cost = AccountOtherCost::find($id);
        $cost->date = date('Y-m-d', strtotime($request->date));
        $cost->amount = $request->amount;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$data->image));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $fileName);
            $cost['image'] = $fileName;
        }
        $cost->description = $request->description;
        $cost->save();

        return redirect()->route('accounts.cost.view')->with('success', 'Data updated successfully!');
    }
}
