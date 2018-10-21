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
            <h1>{{ $page_name }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Search {{ $page_name }}</h3>
                </div>
                <div class="box-body">
                    {!! $dataTable->table(['class' => 'table table-bordered table-striped']) !!}
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <p></p>
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

    <script>
        var url = "{{ route($route_key.'.index') }}";
    </script>

    <script src="{{ asset('js/admin/'.$route_key.'/'.$route_key.'.js') }}"></script>

    <link rel="stylesheet" href="/vendor/datatables/buttons.dataTables.min.css">
    <script src="/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endsection