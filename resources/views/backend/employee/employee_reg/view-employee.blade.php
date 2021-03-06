@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Employee</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Employee</li>
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
                            <h3>Employee List
                                <a class="btn btn-success float-right btn-sm" href="{{ route('employees.reg.add') }}">
                                    <i class="fa fa-plus-circle"></i>Add Employee</a>
                                
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 3%">SL.</th>
                                        <th>Name</th>
                                        <th style="width: 5%">ID No</th>
                                        <th style="width: 11%">Mobile No</th>
                                        <th style="width: 15%">Address</th>
                                        <th style="width: 5%">Gender</th>
                                        <th style="width: 11%">Join Date</th>
                                        <th style="width: 8%">Salary</th>
                                        @if (Auth::user()->role=="Admin")
                                        <th style="width: 8%">Code</th>
                                        @endif
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($allData as $key => $value)

                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->id_no }}</td>
                                        <td>{{ $value->mobile }}</td>
                                        <td>{{ $value->address }}</td>
                                        <td>{{ $value->gender }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->join_date)) }}</td>
                                        <td>{{ $value->salary }}</td>
                                        @if (Auth::user()->role=="Admin")
                                            <td>{{ $value->code }}</td>
                                        @endif

                                        <td>
                                            <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('employees.reg.edit', $value->id)}}">
                                                <i class="fa fa-edit">  </i>
                                            </a>
                                            <a title="Details" target="_blank" id="details" class="btn btn-sm btn-success" href="{{ route('employees.reg.details', $value->id)}}">
                                                <i class="fa fa-eye">  </i>
                                            </a>
                                            {{-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="
                                            {{ route('setups.designation.delete', $value->id) }}">
                                                <i class="fa fa-trash"> </i> --}}
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