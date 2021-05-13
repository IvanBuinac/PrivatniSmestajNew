<div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
    {!! Form::label('user', 'User', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('users', $users, ['class' => 'form-control']) !!}
        {!! $errors->first('users', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('permission') ? 'has-error' : ''}}">
    {!! Form::label('permission', 'Permission', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('permissions', $permissions, ['class' => 'form-control']) !!}
        {!! $errors->first('permissions', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
