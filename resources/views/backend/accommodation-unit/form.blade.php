<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $accommodationunit->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('accommodation_id') ? 'has-error' : ''}}">
    {!! Form::label('accommodation_id', trans('accommodation.accommodation'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('accommodation_id',array('default' => trans('accommodation.choose'))+$accommodations, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('accommodation', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" required>{{ $accommodationunit->description or ''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('space_number') ? 'has-error' : ''}}">
    <label for="space_number" class="col-md-4 control-label">{{ 'Space Number' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="space_number" type="number" id="space_number" value="{{ $accommodationunit->space_number or ''}}" required>
        {!! $errors->first('space_number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('species_id') ? 'has-error' : ''}}">
    {!! Form::label('species_id', trans('accommodation.species'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('species_id',array('default' => trans('accommodation.choose'))+$species, null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('species_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
