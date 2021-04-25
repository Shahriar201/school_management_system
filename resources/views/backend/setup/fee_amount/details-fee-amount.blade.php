@extends('backend.layouts.master')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Fee Category Amount</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Amount</li>
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
                            <h3>Fee Amount Details
                                <a class="btn btn-success float-right btn-sm" href="{{ route('setups.fee.amount.view') }}">
                                    <i class="fa fa-list"></i>Fee Amount List</a>      
                            </h3>
                        </div>

                        <div class="card-body">
                            <h4><strong>Fee Type : </strong>{{ $editData['0']['fee_category']['name'] }}</h4>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Class</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($editData as $key => $value)

                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value['student_class']['name'] }}</td>
                                        <td>{{ $value->amount }}</td>

                                        <td>
                                            <a title="Details" id="details" class="btn btn-sm btn-success" href="{{ route('setups.fee.amount.details', $value->fee_category_id)}}">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('setups.fee.amount.edit', $value->fee_category_id)}}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            
                                            {{-- <a title="Delete" id="delete" class="btn btn-sm btn-danger" href="
                                            {{ route('setups.fee.amount.delete', $value->fee_category_id) }}">
                                                <i class="fa fa-trash">

                                                </i>
                                            </a> --}}
                                        </td>
                                    </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            
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