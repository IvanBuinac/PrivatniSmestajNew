<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('path') ? 'has-error' : ''}}">
    {!! Form::label('path', 'Path', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('path', null, ['class' => 'form-control']) !!}
        {!! $errors->first('path', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('states_id') ? 'has-error' : ''}}">
    {!! Form::label('states_id', 'State', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('states_id',$state,null, ['required' => 'required','class' => 'form-control ']) !!}
        {!! $errors->first('states_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
    {!! Form::label('latitude', 'Latitude', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
        {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
    {!! Form::label('longitude', 'Longitude', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
        {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('zoom') ? 'has-error' : ''}}">
    {!! Form::label('zoom', 'Zoom', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('zoom', null, ['class' => 'form-control']) !!}
        {!! $errors->first('zoom', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('status', null, ['class' => 'form-control']) !!}
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
