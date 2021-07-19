@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Employee Attendance Report</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Attendance</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-md-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3>Search Criteria</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="GET" action="{{ route('reports.attendance.get') }}" id="myForm" target="_blank">
                                @csrf
                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Employee Name <font style="color: red">*</font></label>
                                            <select name="employee_id" id="employee_id"
                                                class="form-control form-control-sm select2">
                                                <option value="">Select Employee</option>
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="">Date</label>
                                            <input type="text" name="date" class="form-control datepicker form-control-sm" placeholder="DD-MM-YYYY" readonly>
                                        </div>

                                        <div class="form-group col-md-3" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </section>

                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

{{-- Validation --}}
<script type="text/javascript">
    $(document).ready(function() {

        $('#myForm').validate({
            rules: {
                "employee_id": {
                    required: true,
                },
                "date": {
                    required: true,
                },
            },
            messages: {
                //terms: "Please accept our terms"
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<!--Datepicker-->
<script>
    $('.datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'yyyy-mm-dd'
    });
</script>



@endsection
