<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">User Permissions</div>
                <div class="panel-body">
                    <a href="{{ route('users.permission_create') }}" class="btn btn-success btn-sm" title="Add New user permision">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                    </a>
                    <br/>
                    <br/>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>ID</th><th>Name</th><th>Permissions</th><th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                            @foreach($item->permissions as $permission)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{$permission->name}}</td>

                                    <td>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'route' => ['users.permission_delete', $item->id ,$permission->name],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete user',
                                                'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>

                            @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
