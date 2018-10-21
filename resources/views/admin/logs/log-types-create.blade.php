@extends('admin.layouts.admin-template-1')

@section('page-title', $page_name)

@section('page-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo $page_name; ?></h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
            <li><a href="{{ route($route_key.'.index') }}">{{ $page_name_breadcrumbs }}</a></li>
            <li class="active">{{ $page_name }}</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">

            <!-- Error messages -->
            @include('admin.partials.alerts.errors')

            <!-- Success Message -->
            @include('admin.partials.alerts.success')

            <div class="box-body">
                {{ Form::open(array('route' => $route_key.'.store')) }}
                    @include('admin.logs.'.$route_key.'-form')
                {{ Form::close() }}
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('page-scripts')
@endsection