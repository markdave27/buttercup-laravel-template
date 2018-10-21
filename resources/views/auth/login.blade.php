<?php
/**
 * login.blade.php
 * - Login page
 * @author Mark Dave
 * 2017-05-14 04:10
 */
?>
@extends('admin.layouts.admin-login-template')

@section('page-title','Login')

@section('page-styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/AdminLTE/plugins/iCheck/square/blue.css')  }}">
@endsection

@section('page-content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ URL::to('admin') }}"><b>{{ config('app.name') }}</b> Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            @include('admin.partials.alerts.errors')
            @include('admin.partials.alerts.success')
            {{ Form::open(['url' => 'login']) }}
            {{--<form action="/admin/blank" method="post">--}}
            @include('auth.login-form')
            {{ Form::close() }}

            {{--<div class="social-auth-links text-center">--}}
            {{--<p>- OR -</p>--}}
            {{--<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
            {{--Facebook</a>--}}
            {{--<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
            {{--Google+</a>--}}
            {{--</div>--}}
            <!-- /.social-auth-links -->

            <span class="margin-top-10"><a href="{{ route('password.reset') }}">Forgot password?</a> or <a href="{{ route('username_reminder') }}">Forgot username?</a> or <a href="{{ route('activation_key_resend') }}">Resend activation code?</a></span>
            {{--<a href="#" class="text-center">Register a new membership</a>--}}

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    @endsection

    @section('page-scripts')
        <!-- iCheck -->
        <script src="{{ asset('bower_components/AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
@endsection