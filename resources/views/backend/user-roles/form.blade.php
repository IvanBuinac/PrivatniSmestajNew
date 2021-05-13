<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('users', $users, ['class' => 'form-control']) !!}
        {!! $errors->first('users', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('permission') ? 'has-error' : ''}}">
    {!! Form::label('roles', 'Roles', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('roles', $roles, ['class' => 'form-control']) !!}
        {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
