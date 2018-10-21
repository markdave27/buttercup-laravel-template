<?php
/**
 * login-form.blade.php
 * @author Mark Dave
 * -
 * 11/27/2016 11:02 PM
 */
?>
<div class="form-group has-feedback">
    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']) }}
    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
</div>
<div class="form-group has-feedback">
    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password',
        'value' => old('password'), 'required' => 'required']) }}
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
</div>
<div class="row">
    <div class="col-xs-8">
        <div class="checkbox icheck">
            {{ Form::checkbox('remember', 'yes') }}
            {{ Form::label('remember', 'Remember Me') }}
            {{--<label>--}}
                {{--<input type="checkbox"> Remember Me--}}
            {{--</label>--}}
        </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
        {{ Form::submit('Sign In', ['class' => 'btn btn-primary btn-block btn-flat']) }}
    </div>
    <!-- /.col -->
</div>
