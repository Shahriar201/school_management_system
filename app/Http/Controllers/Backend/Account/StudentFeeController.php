<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignSubject;
use App\Model\DiscountStudent;
use App\User;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\AssignStudent;
use App\Model\Year;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use DB;
use PDF;
use App\Model\AccountStudentFee;

class StudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountStudentFee::all();

        return view('backend.account.student.view-fee', $data);
    }

    public function add()
    {
        $data['years'] = year::orderBy('id', 'DESC')->get();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();

        return view('backend.account.student.add-fee', $data);
    }

    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));
        $data = AssignStudent::with(['discount'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
     
        $html['thsource'] = '<th>SL.</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $std) {
            $student_fee = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->where('class_id', $std->class_id)->first();
            $account_student_fees = AccountStudentFee::where('student_id', $std->student_id)->where('year_id', $std->year_id)->where('class_id', $std->class_id)->where('fee_category_id', $fee_category_id)->where('date', $date)->first();
            if ($account_student_fees != null) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            // $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['student']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['student']['name'].'<input type="hidden" name="year_id" value="'.$year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['student']['fname'].'<input type="hidden" name="class_id" value="'.$class_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student_fee['amount'].'Tk'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';

            $original_fee = $student_fee['amount'];
            $discount = $std['discount']['discount'];
            $discountable_fee = $discount/100*$original_fee;
            $final_fee = (int)$original_fee-(int)$discountable_fee;
            $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$final_fee.'" class="form-control" readonly>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type ="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style ="transform:scale(1.5);margin-left:10px;">'.'</td>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function store(Request $request){
        $date = date('Y-m', strtotime($request->date));
        AccountStudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('fee_category_id', $request->fee_category_id)->where('date', $date)->delete();
        $checkData = $request->checkmanage;
        if ($checkData != NULL) {
            for ($i=0; $i <count($checkData) ; $i++) { 
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->date = $date;
                $data->fee_category_id = $request->fee_category_id;
                $data->student_id = $request->student_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            return redirect()->route('accounts.fee.view')->with('success', 'Well done! successfully updated');
        }else {
            return redirect()->back()->with('error', 'Sorry! data not saved');
        }
    }
}
