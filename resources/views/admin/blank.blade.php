<?php
$page_name = 'Users';
?>
@extends('admin.layouts.admin-template-1')

@section('page-title', $page_name)

@section('page-styles')
    <link href="{{ URL::to('plugins/bootstrap-dialog/bootstrap-dialog.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Title</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>

                <!-- Error messages -->
                @include('admin.partials.alerts.errors')

                <!-- Success Message -->
                @include('admin.partials.alerts.success')

                <div class="box-body">
                    Start creating your amazing application!
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('page-scripts')
    <!-- Datatables JS -->
    <script src="{{ asset('/bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <!-- Datatables Bootstrap JS -->
    <script src="{{ asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

@endsection

