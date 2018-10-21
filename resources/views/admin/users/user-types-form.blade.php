<div class="form-group">
    {{ Form::label('user_type', 'User Type *') }}
    {{ Form::text('user_type', null, array('class' => 'form-control', 'required' => 'required')) }}
</div>

<div class="form-group">
    <p><strong>* - Required</strong></p>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ link_to_route('user-types.index', 'Back', array(), array('class' => 'btn btn-danger btn-back'))}}

