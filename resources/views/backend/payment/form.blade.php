<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $payment->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
    <label for="picture" class="col-md-4 control-label">{{ 'Picture' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="picture" type="text" id="picture" value="{{ $payment->picture or ''}}" required>
        {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('bwpicture') ? 'has-error' : ''}}">
    <label for="bwpicture" class="col-md-4 control-label">{{ 'Bwpicture' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="bwpicture" type="text" id="bwpicture" value="{{ $payment->bwpicture or ''}}" >
        {!! $errors->first('bwpicture', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
