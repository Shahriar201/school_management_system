@extends('backend.layouts.master')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Manage Others Cost</h1>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Others Cost</li>
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
                                <h3>Others Cost List
                                    <a class="btn btn-success float-right btn-sm" href="{{ route('accounts.cost.add') }}">
                                        <i class="fa fa-plus-circle"></i>Add Others Cost</a>

                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL.</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allData as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d-m-Y', strtotime($data->date)) }}</td>
                                                <td>{{ $data->amount }}</td>
                                                <td>{{ $data->description }}</td>
                                                <td>
                                                    <img src="{{ (!empty($data->image))?url('public/upload/cost_images/'.$data->image):url('public/upload/no_image.jpg') }}"
                                                    style="width: 90px; height: 60px;">
                                                </td>
                                                <td>
                                                    <a title="Edit" id="edit" class="btn btn-sm btn-primary" href="{{ route('accounts.cost.edit', $data->id)}}">
                                                        <i class="fa fa-edit">  </i>
                                                    </a>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
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
