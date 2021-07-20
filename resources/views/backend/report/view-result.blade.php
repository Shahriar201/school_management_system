@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Students Result</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Result</li>
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
                                <h3>Select Criteria
                                    
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="GET" action="{{ route('reports.result.get') }}" id="myForm" target="_blank">
                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label for="year_id">Year</label>
                                            <select name="year_id" id="year_id" class="form-control select2">
                                                <option value="">Select Year</option>
                                                @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="class_id">Class</label>
                                            <select name="class_id" id="class_id" class="form-control select2">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="exam_type_id">Exam Types</label>
                                            <select name="exam_type_id" id="exam_type_id" class="form-control select2">
                                                <option value="">Select Exam Types</option>
                                                @foreach ($exam_types as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
    
                                        <div class="form-group col-md-1" style="padding-top: 30px">
                                            <button class="btn btn-sm btn-block btn-primary" name="search" id="search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- /.card-body -->
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
                year_id: {
                    required: true,
                },
                class_id: {
                    required: true,
                },
                exam_type_id: {
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

@endsection
