<div class="form-group has-float-label">
    {{ Form::text('log_type', null, array('id' => 'log_type', 'class' => 'form-control', 'placeholder' => 'Log Type *', 'required' => 'required')) }}
    {{ Form::label('log_type', 'Log Type *') }}
</div>

<div class="form-group">
    <p><strong>* - Required</strong></p>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ link_to_route($route_key.'.index', 'Back', array(), array('class' => 'btn btn-danger btn-back'))}}
