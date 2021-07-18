@extends('backend.layouts.master')

@section('content')

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
                        <li class="breadcrumb-item active">Grade Point</li>
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
                            <h3>Grade Point List
                                <a class="btn btn-success float-right btn-sm" href="{{ route('marks.grade.add') }}">
                                    <i class="fa fa-plus-circle"></i>Add Grade Point</a>
                                
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Grade Name</th>
                                        <th>Grade Point</th>
                                        <th>Start Marks</th>
                                        <th>End Marks</th>
                                        <th>Point Range</th>
                                        <th>Remarks</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($allData as $key => $value)

                                        <tr class="{{ $value->id }}">
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->grade_name }}</td>
                                            <td>{{ number_format((float)$value->grade_point,2) }}</td>
                                            <td>{{ $value->start_marks }}</td>
                                            <td>{{ $value->end_marks }}</td>
                                            <td>
                                                {{ number_format((float)$value->grade_point,2) }} - {{ ($value->grade_point == 5)
                                                ?(number_format((float)$value->grade_point,2)):(number_format((float)$value->grade_point+1,2) - (float)0.01) }}
                                            </td>
                                            <td>{{ $value->remarks }}</td>
                                            <td>
                                                <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('marks.grade.edit', $value->id)}}">
                                                    <i class="fa fa-edit">  </i>
                                                </a>
                                                {{-- <a title="Details" id="details" class="btn btn-sm btn-success" href="{{ route('employees.attendance.details', $value->date)}}">
                                                    <i class="fa fa-eye">  </i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
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

@endsection