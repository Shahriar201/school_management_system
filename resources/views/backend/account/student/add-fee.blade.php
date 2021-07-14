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
                        <h1 class="m-0">Manage Student Fee</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student Fee</li>
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
                                    Add/Edit Student Fee
                                    <a class="btn btn-success float-right btn-sm"
                                        href="{{ route('accounts.fee.view') }}">
                                        <i class="fa fa-list"></i>Student Fee List</a>
                                </h3>

                            </div>

                            <div class="card-body">
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
                                        <label for="fee_category_id">Fee Category</label>
                                        <select name="fee_category_id" id="fee_category_id" class="form-control select2">
                                            <option value="">Select Fee Category</option>
                                            @foreach ($fee_categories as $fee)
                                                <option value="{{ $fee->id }}">{{ $fee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Date</label>
                                        <input type="text" name="date" id="date" class="form-control datepicker form-control-sm" placeholder="DD-MM-YYYY">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <a id="search" class="btn btn-primary" name="search">Search</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="DocumentResults">
                                    <script id="document-template" type="text/x-handlebars-template">
                                        <form action="{{ route('accounts.fee.store') }}" method="POST">
                                            @csrf

                                            <table class="table-sm table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        @{{{thsource}}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @{{#each this}}
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                </tbody>
                                            </table>
                                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:10px;">Submit</button>
                                        </form>
                                    </script>
                                </div>
                            </div>

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

    {{-- Validation and data get by ajax --}}
    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var fee_category_id = $('#fee_category_id').val();
            var date = $('#date').val();
            $('.notifyjs-corner').html('');

            if (year_id == '') {
                $.notify("Year required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (class_id == '') {
                $.notify("Class required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (fee_category_id == '') {
                $.notify("Fee type required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('accounts.fee.getStudent') }}",
                type: "GET",
                data: {year_id:year_id,class_id:class_id, fee_category_id:fee_category_id, date:date},
                beforeSend: function(){

                },
                success: function(data){
                    var source = $("#document-template").html();
                    var template = Handlebars.compile(source);
                    var html = template(data);
                    $('#DocumentResults').html(html);
                    $('[data-toggle="tooltip"]').tooltip();
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
