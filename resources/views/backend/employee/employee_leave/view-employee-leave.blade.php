@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Employee Leave</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Employee Leave</li>
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
                            <h3>Leave Employee List
                                <a class="btn btn-success float-right btn-sm" href="{{ route('employees.leave.add') }}">
                                    <i class="fa fa-plus-circle"></i>Add Employee Leave</a>
                                
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>ID No</th>
                                        <th>Purpose</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($allData as $key => $value)

                                    <tr class="{{ $value->id }}">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value['user']['name'] }}</td>
                                        <td>{{ $value['user']['id_no'] }}</td>
                                        <td>{{ $value['purpose']['name'] }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->start_date)) }} to {{ date('d-m-Y', strtotime($value->end_date)) }}</td>
                                        <td>
                                            <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('employees.leave.edit', $value->id)}}">
                                                <i class="fa fa-edit">  </i>
                                            </a>
                                            {{-- <a title="Details" target="_blank" id="details" class="btn btn-sm btn-success" href="{{ route('employees.reg.details', $value->id)}}">
                                                <i class="fa fa-eye">  </i>
                                            </a> --}}
                                            </a>
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