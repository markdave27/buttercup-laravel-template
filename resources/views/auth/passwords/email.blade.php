@extends('admin.layouts.admin-login-template')

@section('page-title','Password Reset')

@section('page-styles')
@endsection

@section('page-content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ URL::to('admin') }}"><b>{{ config('app.name') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Reset Password</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @include('admin.partials.alerts.errors')
            @include('admin.partials.alerts.success')
            {{ Form::open(['route' => 'password.email']) }}
            <div class="form-group has-feedback">
                {{ Form::label('email', 'E-Mail Address *') }}
                {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email Address', 'required' => 'required']) }}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                    {{ Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary btn-block btn-flat']) }}
                </div>
                <!-- /.col -->
            </div>
            {{ Form::close() }}

            <span class="margin-top-10"><a href="{{ route('login') }}">Login?</a> or <a href="{{ route('username_reminder') }}">Forgot username?</a> or <a href="{{ route('activation_key_resend') }}">Resend activation code?</a></span>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection

@section('page-scripts')
@endsection