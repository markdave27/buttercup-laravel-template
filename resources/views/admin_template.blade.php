<?php
$page_name = 'Admin Template Sample Page';
?>
@extends('admin.layouts.admin-template-1')

@section('page-title', $page_name)

@section('page-styles')
    <!-- Datatables Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('page-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Page Header
                <small>Optional description</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Your Page Content Here -->
            <table class="datatable mdl-data-table dataTable table table-bordered table-striped" cellspacing="0"
                   width="100%" role="grid">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>

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

    <script>
        var serverSide = "{{ route('datatables-server-side') }}";
        var url = "{{ route('datatables.index') }}";
    </script>

    <script src="{{ asset('/js/datatables.js') }}"></script>
@endsection