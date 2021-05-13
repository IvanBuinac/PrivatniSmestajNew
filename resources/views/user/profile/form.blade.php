<script type="text/javascript">
    $(document).ready(function() {
        $('#state').on('change', function (e) {
            e.preventDefault();
            var state = $('#state').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '<?php print route("AJAXState"); ?>',
                data: {state: state},
                success: function( msg ) {
                    $("#city").empty();
                    $("#city").append($("<option></option>").text('{{trans('accommodation.choose')}}').attr('value',"default"));
                    $.each(msg.cities, function(i, value) {
                        $("#city").append($("<option></option>").text(value).attr('value', i));
                    });
                }
            });
        });
    });
</script>
<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    {!! Form::label('photo', 'Photo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
     <img src="<?php if(!$user->photo){ print asset("storage/images/NoProfilePicture.png");}else{ print asset("storage/images/users/$user->name/$user->photo");} ?>" id="photo" alt="profile photo"></img>
        {!! Form::file('photo',  ['class' => 'form-control hidden',"id"=>"photoTar"]) !!}
        {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans("registration.name"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('surname') ? 'has-error' : ''}}">
    {!! Form::label('surname', trans("registration.surname"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('surname', null, ['class' => 'form-control']) !!}
        {!! $errors->first('surname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
    {!! Form::label('state_id', trans('accommodation.State'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('state_id',array('default' => trans('accommodation.choose'))+$states, $state , ['class' => 'form-control', 'required' => 'required', 'id'=>"state"]) !!}
        {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
    {!! Form::label('city_id', trans('accommodation.City'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <?php if(isset($citissssss)){?>
        {!! Form::select('city_id',array('default' => trans('accommodation.choose'))+$citissssss, $city, ['class' => 'form-control', 'required' => 'required' , 'id'=>"city"]) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
        <?php }else{?>
        {!! Form::select('city_id',array('default' => trans('accommodation.choose')), null, ['class' => 'form-control', 'required' => 'required' , 'id'=>"city"]) !!}
        {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
        <?php }?>
    </div>
</div>
<div class="form-group {{ $errors->has('telephone') ? 'has-error' : ''}}">
    {!! Form::label('telephone', trans("registration.telephone"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('telephone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('telephone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', trans("registration.email") , ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('accommodation_number') ? 'has-error' : ''}}">
    {!! Form::label('accommodation_number', trans("registration.accommodation_number"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('accommodation_number', null, ['class' => 'form-control',"disabled"]) !!}
        {!! $errors->first('accommodation_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('accommodation_unit_number') ? 'has-error' : ''}}">
    {!! Form::label('accommodation_unit_number', trans("registration.accommodation_unit_number"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('accommodation_unit_number', null, ['class' => 'form-control',"disabled"]) !!}
        {!! $errors->first('accommodation_unit_number', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password',  trans("registration.password"), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password',  ['class' => 'form-control']) !!}
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>
