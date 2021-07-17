@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Monthly/Yearly Profit</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Monthly/Yearly Profit</li>
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
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label>Start Date</label>
                                        <input type="text" name="start_date" id="start_date"
                                            class="form-control datepicker form-control-sm" placeholder="YYYY-MM-DD"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>End Date</label>
                                        <input type="text" name="end_date" id="end_date"
                                            class="form-control datepicker1 form-control-sm" placeholder="YYYY-MM-DD"
                                            readonly>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <a class="btn btn-sm btn-block btn-success" id="search" style="margin-top:30px; color:white;">Search</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="DocumentResults">
                                    <script id="document-template" type="text/x-handlebars-template">
                                        

                                            <table class="table-sm table-bordered table-striped" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        @{{{thsource}}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                    <tr>
                                                        @{{{tdsource}}}
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>                                      
                                    </script>
                                </div>
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

    {{-- Validation and data get by ajax --}}
    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            $('.notifyjs-corner').html('');
           
            if (start_date == '') {
                $.notify("Start Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            if (end_date == '') {
                $.notify("End Date required", {
                    globalPosition: 'top right',
                    className: 'error'
                });
                return false;
            }
            $.ajax({
                url: "{{ route('reports.profit.datewise.get') }}",
                type: "GET",
                data: {'start_date':start_date, 'end_date':end_date},
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
        $('.datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>

@endsection
