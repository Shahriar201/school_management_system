<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountStudentFee;
use App\Model\AccountEmployeeSalary;
use App\Model\EmployeeAttendance;
use App\Model\AccountOtherCost;
use PDF;
use App\User;
use App\Model\StudentMarks;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\MarksGrade;
use App\Model\AssignStudent;

class ProfitController extends Controller
{
    public function view()
    {
        return view('backend.report.view-profit');
    }

    public function profit(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('date', [$sdate, $edate])->sum('amount');
        $employee_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $total_cost = $other_cost+$employee_salary;
        $profit = $student_fee-$total_cost;
        
        $html['thsource'] = '<th>Students Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';
        $html['tdsource'] = '<td>'.$student_fee.'</td>';
        $html['tdsource'] .= '<td>'.$other_cost.'</td>';
        $html['tdsource'] .= '<td>'.$employee_salary.'</td>';
        $html['tdsource'] .= '<td>'.$total_cost.'</td>';
        $html['tdsource'] .= '<td>'.$profit.'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PDF" target="_blank" 
        href="'.route("reports.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'">
        <i class="fa fa-file"></i></a>';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function pdf(Request $request)
    {
        $data['sdate'] = date('Y-m', strtotime($request->start_date));
        $data['edate'] = date('Y-m', strtotime($request->end_date));
        $data['start_date'] = date('Y-m-d', strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d', strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.pdf.monthly-profit-pdf', $data);
        return $pdf->stream('montyly/yearly profit.pdf');
    }

    public function marksheetView()
    {
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.report.marksheet-view', $data);
    }

    public function marksheetGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('marks', '<', '33')->get()->count();
        $single_student = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();
        if ($single_student == true) {
            $allMarks = StudentMarks::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            $allGrades = MarksGrade::all();

            return view('backend.report.pdf.marksheet-pdf', compact('allMarks', 'allGrades', 'count_fail'));
        } else {
            return redirect()->back()->with('error', 'Sorry! These criteria does not match');
        }
    }

    public function attendanceView()
    {
        $data['employees'] = User::where('user_type', 'employee')->get();

        return view('backend.report.view-attendance', $data);
    }
    
    public function attendanceGet(Request $request){
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id', $employee_id];
        }
        $date = date('Y-m', strtotime($request->date));
        if ($date != '') {
            $where[] = ['date', 'like', $date.'%'];
        }
        $single_attendance = EmployeeAttendance::with(['user'])->where($where)->first();
        if ($single_attendance == true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->get();
            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Leave')->get()->count();
            $data['month'] = date('M Y', strtotime($request->date));

            $pdf = PDF::loadView('backend.report.pdf.attendance-pdf', $data);
            return $pdf->stream('employee_attendance_report.pdf');
        }else {
            return redirect()->back()->with('error', 'Sorry! these criteria does not match');
        }
    }

    public function resultView(){
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();

        return view('backend.report.view-result', $data);
    }

    public function resultGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $single_result = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->first();
        if ($single_result == true) {
            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id')->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();

            $pdf = PDF::loadView('backend.report.pdf.result-pdf', $data);
            return $pdf->stream('student_result.pdf');
        }else{
            return redirect()->back()->with('error', 'Sorry! these criteria does not match');
        }
    }
    
    public function idCardView(){
        $data['years'] = Year::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();

        return view('backend.report.view-id-card', $data);
    }

    public function idCardGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $check_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();
        if ($check_data == true) {
            $data['allData'] = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
            // dd($data['allData']->toArray());
            $pdf = PDF::loadView('backend.report.pdf.id-card-pdf', $data);
            return $pdf->stream('student_result.pdf');
        }else{
            return redirect()->back()->with('error', 'Sorry! these criteria does not match');
        }
    }

}
