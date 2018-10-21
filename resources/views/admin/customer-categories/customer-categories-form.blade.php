<div class="form-group has-float-label">
    {{ Form::text('customer_category', null, array('id' => 'customer_category', 'class' => 'form-control', 'placeholder' => 'Customer Category *', 'required' => 'required')) }}
    {{ Form::label('customer_category', 'Customer Category *') }}
</div>

<div class="form-group has-float-label">
    {{ Form::text('description', null, array('id' => 'description', 'class' => 'form-control', 'placeholder' => 'Description')) }}
    {{ Form::label('description', 'Description') }}
</div>

<div class="form-group">
    <p><strong>* - Required</strong></p>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ link_to_route($route_key.'.index', 'Back', array(), array('class' => 'btn btn-danger btn-back'))}}
