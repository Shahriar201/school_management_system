@extends('backend.layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/css/attend.css') }}">
    <style type="text/css">
        .switch-toggle {
            width: auto;
        }

        .switch-toggle label:not(.disable) {
            cursor: pointer;
        }

        .switch-candy a {
            border: 3px solid #333;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgb(0, 0, 0, 0.2), inset 0 1px 1px rgb(255, 255, 255, 0.45);
            background-color: #5a6268;
            background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.2), transparent);
            background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), transparent);
        }

        .switch-toggle.switch-candy,
        .switch-light.switch-candy>span {
            background-color: rgb(223, 235, 230);
            border-radius: 3px;
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255, 255, 255, 0.2);
        }

    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Student Grade Point</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Erade Point</li>
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

                                <h3>
                                    @if (isset($editData))
                                        Edit Grade Point
                                    @else
                                        Add Grade Point
                                    @endif

                                    <a class="btn btn-success float-right btn-sm"
                                        href="{{ route('marks.grade.view') }}">
                                        <i class="fa fa-list"></i>Grade Point List</a>
                                </h3>

                            </div>

                            <form method="POST" action="{{ (@$editData)? route('marks.grade.update', $editData->id): route('marks.grade.store') }}" id="myForm">
                                @csrf

                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="">Grade Name</label>
                                            <input type="text" name="grade_name" value="{{ @$editData->grade_name }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Grade Point</label>
                                            <input type="text" name="grade_point" value="{{ @$editData->grade_point }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Start Makrs</label>
                                            <input type="text" name="start_marks" value="{{ @$editData->start_marks }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">End Makrs</label>
                                            <input type="text" name="end_marks" value="{{ @$editData->end_marks }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Start Point</label>
                                            <input type="text" name="start_point" value="{{ @$editData->start_point }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">End Point</label>
                                            <input type="text" name="end_point" value="{{ @$editData->end_point }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Remarks</label>
                                            <input type="text" name="remarks" value="{{ @$editData->remarks }}" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4" style="padding-top: 30px">
                                            <button type="submit" class="btn btn-success">{{ (@$editData)? 'Update' : 'Submit' }}</button>
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

    <!-- Page specific validation script -->
    <script type="text/javascript">
        $(document).ready(function() {

            $('#myForm').validate({
                rules: {
                    "grade_name": {
                        required: true,
                    },
                    "grade_point": {
                        required: true,
                    },
                    "start_marks": {
                        required: true,
                    },
                    "end_marks": {
                        required: true,
                    },
                    "start_point": {
                        required: true,
                    },
                    "remarks": {
                        required: true,
                    }
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

@endsection
