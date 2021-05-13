@extends(' backend.layouts.app')
@section("title")
    Accommodation unit
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Accommodation unit</div>
                    {!! Form::open(['method' => 'GET', 'route' => 'accommodation-unit.index', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </form>
                    <div class="panel-body">

                        <a href="{{ route('accommodation-unit.create') }}" class="btn btn-success btn-sm" title="Add New Accommodation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="panel panel-default">
                                        <div class="panel-heading row">
                                            <div class="col-xs-2 col-sm-2">#</div>
                                            <div class="col-xs-2 col-sm-2">Name</div>
                                            <div class="col-xs-2 col-sm-2">Accommodation</div>
                                            <div class="col-xs-2 col-sm-2">Description</div>
                                            <div class="col-xs-2 col-sm-2">Actions</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="panel-body">
                                @foreach($accommodationunit as $item)
                                        <div class="row">
                                            <div class="col-xs-2 col-sm-2">{{ $loop->iteration or $item->id }}</div>
                                            <div class="col-xs-2 col-sm-2">{{ $item->name }}</div>
                                            <div class="col-xs-2 col-sm-2">
                                            @foreach($item->accommodation()->get() as $grad)
                                                {{$grad->name}}
                                            @endforeach
                                            </div>
                                            <div class="col-xs-2 col-sm-2">{{ $item->description }}</div>

                                            <div class="col-xs-2 col-sm-2">
                                            <a href="{{ url('/accommodation-unit/' . $item->id) }}" title="View AccommodationUnit"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/accommodation-unit/' . $item->id . '/edit') }}" title="Edit AccommodationUnit"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/accommodation-unit' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete AccommodationUnit" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                            </div>
                                        </div>
                                            <hr class="col-xs-12 col-sm-12 col-md-12">
                                @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="pagination-wrapper"> {!! $accommodationunit->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
