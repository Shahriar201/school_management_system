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
                        <h1 class="m-0">Manage Employee Salary</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employee Salary</li>
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
                                    Add/Edit Employee Salary
                                    <a class="btn btn-success float-right btn-sm"
                                        href="{{ route('accounts.salary.view') }}">
                                        <i class="fa fa-list"></i>Employee Salary List</a>
                                </h3>

                            </div>

                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="" class="control-label">Date</label>
                                        <input type="text" name="date" id="date" class="form-control form-control-sm datepicker" 
                                        autocomplete="off" placeholder="Date" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <a class="btn btn-sm btn-success" id="search" style="margin-top:30px; color:white">Search</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="DocumentResults">
                                    <script id="document-template" type="text/x-handlebars-template">
                                        <form action="{{ route('accounts.salary.store') }}" method="POST">
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
            var date = $('#date').val();
            $('.notifyjs-corner').html('');
           
            if (date == '') {
                $.notify("Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('accounts.salary.getEmployee') }}",
                type: "GET",
                data: {date:date},
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
