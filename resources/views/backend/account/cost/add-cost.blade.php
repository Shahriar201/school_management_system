@extends('backend.layouts.master')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/backend/css/attend.css') }}">
    {{-- <style type="text/css">
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

    </style> --}}
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
                                <h3>
                                    @if (isset($editData))
                                        Edit Cost
                                    @else
                                        Add Cost
                                    @endif
                                </h3>
                                <a class="btn btn-success float-right btn-sm" href="{{ route('accounts.cost.view') }}">
                                    <i class="fa fa-list"></i>Others Cost List</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">

                                {{-- User add form --}}
                                <form method="post"
                                    action="{{ @$editData ? route('accounts.cost.update', $editData->id) : route('accounts.cost.store') }}"
                                    id="myForm" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Date <font style="color: red">*</font></label>
                                            <input type="text" name="date" value="{{ @$editData->date }}"
                                                class="form-control form-control-sm datepicker">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Amount<font style="color: red">*</font></label>
                                            <input type="text" name="amount" value="{{ @$editData->amount }}" class="form-control form-control-sm">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Image</label>
                                            <input type="file" name="image" class="form-control form-control-sm" id="image">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <img id="showImage"
                                                src="{{ !empty($editData->image) ? url('public/upload/cost_images/' . $editData->image) : url('public/upload/no_image.jpg') }}"
                                                style="width: 300px; height: 100px; border: 1px solid #000;">

                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Description<font style="color: red">*</font></label>
                                            <textarea name="description" id="description" rows="4" class="form-control form-control-sm">{{ @$editData->description }}</textarea>
                                        </div>

                                    </div>

                                    <button type="submit"
                                        class="btn btn-primary btn-sm">{{ @$editData ? 'Update' : 'Submit' }}</button>

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

    <!-- Page specific validation script -->
<script type="text/javascript">
    $(document).ready(function() {
    
    $('#myForm').validate({
        rules: {
            "date": {
            required: true,
            },
        "amount": {
            required: true,
            },
        "description": {
            required: true,
            },
        "mobile": {
            required: true,
            },
        
        },
        messages: {
        //terms: "Please accept our terms"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
            },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
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
