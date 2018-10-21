<div class="form-group has-float-label">
    {{ Form::text('given_name', null, array('id' => 'given_name', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Given Name *')) }}
    {{ Form::label('given_name', 'Given Name *') }}
</div>

<div class="form-group has-float-label">
    {{ Form::text('surname', null, array('id' => 'surname', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Surname *')) }}
    {{ Form::label('surname', 'Surname *') }}
</div >

<div class="form-group has-float-label">
    {{ Form::email('email', null, array('id' => 'email', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email *')) }}
    {{ Form::label('email', 'Email *') }}
</div>

<div class="form-group has-float-label">
    {{ Form::text('username', null, array('id' => 'username', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'Username *')) }}
    {{ Form::label('username', 'Username *') }}
</div>

<div class="form-group has-float-label">
    {{ Form::password('password', array('id' => 'password', 'class' => 'form-control', 'value' => old('password'), 'required' => 'required', 'placeholder' => 'Password *')) }}
    {{ Form::label('password', 'Password *') }}
{{--    {{ Form::input('password', 'password', null, array('class' => 'form-control')) }}--}}
</div>

<div class="form-group has-float-label">
    {{ Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'value' => old('password_confirmation'), 'required' => 'required', 'placeholder' => 'Confirm Password *')) }}
    {{ Form::label('password_confirmation', 'Confirm Password *') }}
{{--    {{ Form::input('password', 'password_confirmation', null, array('class' => 'form-control')) }}--}}
</div>

{{--<div class="form-group">--}}
    {{--{{ Form::label('user_type_id', 'User Type *') }}--}}
    {{--{{ Form::select('user_type_id', $user_types, null, array('class' => 'form-control', 'required' => 'required')) }}--}}
{{--</div>--}}

<div class="form-group">
    {{ Form::label('', 'User Type *') }}
    <br />
    @foreach($user_types as $user_type_value => $user_type)
        <label class="checkbox-inline checkbox-inline-fix">
            @if(isset($roles))
                {{ Form::checkbox('user_type_id[]', $user_type_value, (isset($roles[$user_type_value]) ? 1 : 0)) }}
            @else
                {{ Form::checkbox('user_type_id[]', $user_type_value, null) }}
            @endif
            {{ $user_type }}
        </label>
    @endforeach
</div>

<div class="form-group">
    <p><strong>* - Required</strong></p>
</div>

{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
{{ link_to_route($route_key.'.index', 'Back', array(), array('class' => 'btn btn-danger btn-back'))}}