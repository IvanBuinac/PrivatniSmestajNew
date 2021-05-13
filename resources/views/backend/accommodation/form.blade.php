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
<div id='ajaxResponse'></div>
<div class="tab-content">
    <div class="tab-pane active" role="tabpanel" id="step1">
        <h3>{{trans('accommodation.Step1')}}</h3>
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
            {!! Form::label('name',trans('accommodation.Name') , ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('state_id') ? 'has-error' : ''}}">
            {!! Form::label('state_id', trans('accommodation.State'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('state_id',array('default' => trans('accommodation.choose'))+$states, null, ['class' => 'form-control', 'required' => 'required', 'id'=>"state"]) !!}
                {!! $errors->first('state_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
            {!! Form::label('city_id', trans('accommodation.City'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                <?php if(isset($cities)){?>
                {!! Form::select('city_id',array('default' => trans('accommodation.choose'))+$cities, null, ['class' => 'form-control', 'required' => 'required' , 'id'=>"city"]) !!}
                {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
                <?php }else{?>
                {!! Form::select('city_id',array('default' => trans('accommodation.choose')), null, ['class' => 'form-control', 'required' => 'required' , 'id'=>"city"]) !!}
                {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
                <?php }?>
            </div>
        </div>
        @can('edit all accommodation')
        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
            {!! Form::label('user_id', trans('accommodation.User'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @endcan
        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
            {!! Form::label('category_id', trans('accommodation.Category'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('category_id', array('default' => trans('accommodation.choose'))+$categories,null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('type_id') ? 'has-error' : ''}}">
            {!! Form::label('type_id', trans('accommodation.Type'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('type_id', array('default' => trans('accommodation.choose'))+ $types,null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('type_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', trans('accommodation.Description'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('capacity') ? 'has-error' : ''}}">
            {!! Form::label('capacity', trans('accommodation.Capacity'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::number('capacity', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('deposit') ? 'has-error' : ''}}">
            {!! Form::label('deposit', trans('accommodation.Deposit'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('deposit',$deposit, null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('deposit', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
            {!! Form::label('website', 'Website', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('website', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
            {!! Form::label('address', trans('accommodation.Adress'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        @foreach($renting as $key => $ren)
            <?php $promenljiva=null;
            if(isset($accommodation)){
            ?>

            @foreach($accommodation->rentings()->get() as $pera)

                @if($pera->id==$ren->id)
                    <?php $promenljiva=1;?>
                @endif
            @endforeach
            <?php }?>
            <div class="form-group {{ $errors->has("renting[]") ? 'has-error' : ''}}">
                {!! Form::label('renting[]', $ren->name , ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::checkbox("renting[]","$ren->id", isset($promenljiva) ? true : null ) !!}
                    {!! $errors->first('renting[]', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        @endforeach
        @foreach($period as $key => $per)
            <?php $promenljiva=null;
            if(isset($accommodation)){?>
            @foreach($accommodation->periods()->get() as $pera)

                @if($pera->id==$per->id)
                    <?php $promenljiva=1;?>
                @endif
            @endforeach
            <?php } ?>
            <div class="form-group {{ $errors->has("period[]") ? 'has-error' : ''}}">
                {!! Form::label('period[]', $per->name , ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::checkbox("period[]","$per->id",isset($promenljiva) ? true : null )!!}
                    <img src="{{ asset("../storage/app/public/images/doba/".$per->picture) }}" width="50" height="50" ></img>
                    {!! $errors->first('period[]', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        @endforeach
        <div class="form-group {{ $errors->has('priority') ? 'has-error' : ''}}">
            {!! Form::label('priority', trans('accommodation.Priority'), ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('priority',$priority, null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('priority', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('premium') ? 'has-error' : ''}}">
            {!! Form::label('premium', 'Premium', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('premium', $premium ,null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('premium', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
            {!! Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::select('status',$status ,null, ['class' => 'form-control']) !!}
                {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-primary next-step">Continue</button></li>
        </ul>
    </div>
    <div class="tab-pane" role="tabpanel" id="step2">
        <h3>{{trans('accommodation.Step2')}}</h3>
        <div class="form-group {{ $errors->has('longitude') ? 'has-error' : ''}}">
            {!! Form::label('longitude', 'Longitude', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('longitude', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('longitude', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('latitude') ? 'has-error' : ''}}">
            {!! Form::label('latitude', 'Latitude', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('latitude', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('latitude', '<p class="help-block">:message</p>') !!}
            </div>
        </div><div class="form-group {{ $errors->has('youtube_link') ? 'has-error' : ''}}">
            {!! Form::label('youtube_link', 'Youtube Link', ['class' => 'col-md-4 control-label']) !!}
            <div class="col-md-6">
                {!! Form::text('youtube_link', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('youtube_link', '<p class="help-block">:message</p>') !!}
            </div></div>
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
            <li><button type="button" class="btn btn-primary next-step">Continue</button></li>
        </ul>
    </div>
    <div class="tab-pane" role="tabpanel" id="step3">
        <h3>{{trans('accommodation.Step3')}}</h3>
            @foreach($distances as $key1 => $distance)

            <?php $promenljiva=null; ?>
            @foreach($distance->accommodations()->get() as $acc)

                @if($acc->id==$ren->id)
                    <?php $promenljiva=$acc->pivot->distance; ?>
                @endif
            @endforeach
            <div class="form-group {{ $errors->has('distance[]') ? 'has-error' : ''}}">
                {!! Form::label('distance[]', $distance->name , ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('iddistance[]', $distance->id, ['class' => 'form-control hidden']) !!}
                    {!! Form::text('distance[]', $promenljiva, ['class' => 'form-control']) !!}
                    {!! $errors->first('$distance[]', '<p class="help-block">:message</p>') !!}
                </div></div>
            @endforeach
        <ul class="list-inline pull-right">
            <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
            <li><button type="button" class="btn btn-default next-step">Skip</button></li>
            <li><button type="button" class="btn btn-primary btn-info-full next-step">Cntinue</button></li>
        </ul>
    </div>
    <div class="tab-pane" role="tabpanel" id="step4">
        <h3>{{trans('accommodation.Step4')}}</h3>
        @foreach($characteristics as $characteristic)
            @if($characteristic->chack==1)
            <div class="form-group {{ $errors->has('characteristic[]') ? 'has-error' : ''}}">
                {!! Form::label('characteristic[]', $characteristic->name , ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::checkbox('characteristic[]', $characteristic->id) !!}
                    {!! $errors->first('characteristic[]', '<p class="help-block">:message</p>') !!}
                </div></div>
            @else
                <div class="form-group {{ $errors->has('characteristics[]') ? 'has-error' : ''}}">
                    {!! Form::label('characteristics[]', $characteristic->name , ['class' => 'col-md-4 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text('idcharacteristics[]', $characteristic->id , ['class' => 'form-control hidden']) !!}
                        {!! Form::select('characteristics[]',["0"=>trans("site.chose"),"1"=>"svaka soba svaki apartman","2"=>"Neje sobe neki apartmani","3"=>"Nema"], null, ['class' => 'form-control']) !!}
                        {!! $errors->first('characteristics[]', '<p class="help-block">:message</p>') !!}
                    </div></div>
            @endif



        @endforeach
        <div class="form-group">
            <div class="col-md-offset-4 col-md-4">
                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>





