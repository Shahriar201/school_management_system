<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly Salary Details</title>
    <link rel="stylesheet" href="{{ asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style type="text/css">
        table{
            border-collapse: collapse;
        }
        h2 h3{
            margin: 0;
            padding: 0;
        }
        .table{
            width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }
        .table .table {
            background-color: #fff;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .text-center {
            text-align: center;   
        }
        .text-right {
            text-align: right;
        }
        table tr td {
            padding: 5px;
        }
        .table-bordered thead th, .table-bordered td, .table-bordered th {
            border: 1px solid black !important;
        }
        .table-bordered thead th {
            background-color: #cacaca;
        }
    
    </style>
</head>
<body>
    <div class="container">

        @php
            $date = date('Y-m', strtotime($total_attendance_groupby_id['0']->date));
            if ($date!='') {
                $where[] = ['date', 'like', $date.'%'];
            }
            $total_attend = App\Model\EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $total_attendance_groupby_id['0']->employee_id)->get();
            $singleSalary = (float)$total_attendance_groupby_id['0']['user']['salary'];
            $salaryPerDay = (float)$singleSalary/30;
            $absentCount = count($total_attend->where('attend_status', 'Absent'));
            $totalSalaryMinus = (int)$absentCount*(float)$salaryPerDay;
            $totalSalary = (int)$singleSalary - (int)$totalSalaryMinus;
        @endphp

        <div class="row">
            <div class="col-md-12">
                <table width="80%">
                    <tr>
                        <td width="33%"></td>
                        {{-- <td width="33%" class="text-center"><img src="{{ url('public/upload/school_image.png') }}" style="width: 100px;heigh: 100px">
                        </td> --}}

                        <td class="text-center" width="63%">
                            <h4><strong>Rashidpur High School</strong></h4>
                            <h5><strong>Kaliakair, Gazipur</strong></h5>
                            <h6><strong>www.rashidpurschool.com</strong></h6>
                        </td>
                        <td width="33%"></td>
                        {{-- <td class="text-center"><img src="{{ (!empty($total_attendance_groupby_id['0']['user']['image'])) ? url('public/upload/employee_images/'.$total_attendance_groupby_id['0']['user']['image']) : url('public/upload/no_image.jpg') }}" style="width: 100px: height: 100px">
                        </td> --}}
                        
                    </tr>
                </table>
            </div>
            <div class="col-md-12 text-center">
                <h5 style="font-weight: bold; padding-top: -25px">Employee Monthly Salary</h5>
            </div>
            <div class="col-md-12">
                <table border="1" width="100%">
                    <tbody>
                        <tr>
                            <td style="width: 50%">Employee Name</td>
                            <td>{{ $total_attendance_groupby_id['0']['user']['name'] }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Basic Salary</td>
                            <td>{{ $total_attendance_groupby_id['0']['user']['salary'] }}</td>
                        </tr>
                        <tr>
                            <td>Total Absent in this Month</td>
                            <td>{{ $absentCount }}</td>
                        </tr>
                        <tr>
                            <td>Month</td>
                            <td>{{ date('M-Y', strtotime($total_attendance_groupby_id['0']->date)) }}</td>
                        </tr>
                        <tr>
                            <td>Salary for this Month</td>
                            <td>{{ $totalSalary }}</td>
                        </tr>
                                                
                    </tbody>
                </table>
                <i style="font-size: 10px; float: right;">Print Date: {{ date("d M Y") }}</i>
            </div>
        </div><br/>
        <div class="col-md-12">
            <table border="0" width="100%">
                <tbody>
                    <tr>
                        <td style="width: 30%"></td>
                        <td style="width: 30%"></td>
                        <td style="width: 40%; text-align: center";>
                            <hr style="border: solid 1px; width: 60%; color: #000; margin-bottom: 0px">
                            <p style="text-align: center;">Principal/Headmaster</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>