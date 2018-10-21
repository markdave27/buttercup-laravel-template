<?php
$page_name = 'Customer Searching Page';
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
            <h1>{{ $page_name }}</h1>
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
                    @foreach($columns as $column_id => $column)
                        <th>{{ $column }}</th>
                    @endforeach
                    <th>Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    @foreach($columns as $column_id => $column)
                        <th>{{ $column }}</th>
                    @endforeach
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
        var serverSide = "{{ route('customers-server-side') }}";
        var url = "{{ route('customers.index') }}";
        var js_columns = {!! $js_columns !!};
    </script>

    <script src="{{ asset('/js/admin/customers/customers.js') }}"></script>
@endsection