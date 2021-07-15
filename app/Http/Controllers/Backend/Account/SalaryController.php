<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmployeeSalary;
use App\Model\EmployeeAttendance;
use App\User;

class SalaryController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountEmployeeSalary::all();

        return view('backend.account.employee.view-salary', $data);
    }

    public function add()
    {
        return view('backend.account.employee.add-salary');
    }

    public function getEmployee(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date.'%'];
        }
        
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        
        $html['thsource'] = '<th>SL.</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This month)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $attend) {
            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();
            if ($account_salary != NULL) {
                $checked = 'checked';
            }else {
                $checked = '';
            }
            $total_attend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absent_count = count($total_attend->where('attend_status', 'Absent'));

            // $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';

            $salary = (float)$attend['user']['salary'];
            $salaryperday = (float)$salary/30;

            $total_salary_minus = (float)$absent_count*(float)$salaryperday;
            $totalsalary = (float)$salary-(float)$total_salary_minus;
                
            $html[$key]['tdsource'] .='<td>'.$totalsalary.'TK'.'<input type="hidden" name="amount[]" value="'.$totalsalary.'"'.'>'.'</td>';
            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type ="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style ="transform:scale(1.5);margin-left:10px;">'.'</td>';
        }
        // dd(@$html);
        return response()->json(@$html);
    }

    public function store(Request $request){
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();
        $checkData = $request->checkmanage;

        if ($checkData != NULL) {
            for ($i=0; $i <count($checkData) ; $i++) { 
                $data = new AccountEmployeeSalary();;
                $data->date = $date;
                $data->employee_id = $request->employee_id[$checkData[$i]];
                $data->amount = $request->amount[$checkData[$i]];
                $data->save();
            }
        }
        if (!empty(@$data) || empty($checkData)) {
            return redirect()->route('accounts.salary.view')->with('success', 'Well done! successfully updated');
        }else {
            return redirect()->back()->with('error', 'Sorry! data do not saved');
        }
    }
}
