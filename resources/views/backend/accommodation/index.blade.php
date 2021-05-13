@extends('backend.layouts.app')
@section("title")
    Accommodation
@endsection
@section('content')
    <div class="container">
        <div class="row">


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading">Accommodation</div>
                    {!! Form::open(['method' => 'GET', 'route' => 'accommodation.index', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                    {!! Form::close() !!}
                    <div class="panel-body">
                        <a href="{{ route('accommodation.create') }}" class="btn btn-success btn-sm" title="Add New Accommodation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>





                        <br/>
                        <br/>
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 ">
                                        <div class="panel panel-default">

                                            <div class="panel-heading row">
                                                <div class="col-xs-2 col-sm-2">ID</div>
                                                <div class="col-xs-3 col-sm-3">{{trans("accommodation.Name")}}</div>
                                                <div class="col-xs-3 col-sm-3">{{trans("accommodation.City")}}</div>
                                                <div class="col-xs-2 col-sm-2">{{trans("accommodation.User")}}</div>
                                                <div class="col-xs-2 col-sm-2">Actions</div>
                                            </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="panel-body">
                                @foreach($accommodation as $item)

                                            <div class="row">
                                                <div class="col-xs-2 col-sm-2">{{ $item->id }}</div>
                                                <div class="col-xs-2 col-sm-3">{{ $item->name }}</div>
                                                <div class="col-xs-2 col-sm-3">
                                                    @foreach($item->city()->get() as $grad)
                                                        {{$grad->name}}
                                                        @endforeach
                                                    </div>
                                                <div class="col-xs-2 col-sm-2">
                                                    @foreach($item->user()->get() as $user)
                                                        {{$user->name}}
                                                    @endforeach
                                                </div>
                                                <div class="col-xs-2 col-sm-2">
                                            <a href="{{ route('accommodation.show',$item->id) }}" title="View Accommodation"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ route('accommodation.edit',$item->id) }}" title="Edit Accommodation"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'route' => ['accommodation.destroy', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Accommodation',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                                    </div>
                                        </div>
                                            <hr class="col-xs-12 col-sm-12 col-md-12">
                                @endforeach
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="pagination-wrapper"> {!! $accommodation->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
@endsection
