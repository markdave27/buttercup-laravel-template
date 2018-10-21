<?php
/**
 * dashboard.blade.php
 * -
 * @author Sophie
 * 23/10/2016 3:40 AM
 */
$page_name = 'Users';
?>
@extends('admin.layouts.admin-template-1')

@section('page-title', $page_name)

@section('page-styles')
    <!-- Bootstrap Dialog CSS -->
    <link href="{{ asset('bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Datatables Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
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
                <div class="table-responsive">
                    <table class="datatable mdl-data-table dataTable table table-bordered table-striped" cellspacing="0"
                           width="100%" role="grid" style="width: 100%;">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Country</th>
                            <th class="text-center">Salary ($)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>

    <!-- Datatables Bootstrap JS -->
    <script src="{{ asset('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <!-- Bootstrap Dialog -->
    <script src="{{ asset('bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js') }}"></script>
@endsection

