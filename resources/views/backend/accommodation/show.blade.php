@extends('backend.layouts.app')
@section("title")
    Accommodation
@endsection
@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Accommodation {{ $accommodation->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/accommodation') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/accommodation/' . $accommodation->id . '/edit') }}" title="Edit Accommodation"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['accommodation', $accommodation->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Accommodation',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $accommodation->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $accommodation->name }} </td></tr><tr><th> City Id </th><td> {{ $accommodation->city_id }} </td></tr><tr><th> User Id </th><td> {{ $accommodation->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
