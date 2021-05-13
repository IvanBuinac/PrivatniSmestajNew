<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;


        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")
				->orWhere('email', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }





        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

        $requestData["password"]=bcrypt($request->password);

        User::create($requestData);

        Session::flash('flash_message', 'User added!');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $requestData = $request->all();

        $requestData["password"]=bcrypt($request->password);

        $user = User::findOrFail($id);
        $user->update($requestData);

        Session::flash('flash_message', 'User updated!');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect(route('users.index'));
    }

    public function permission_create()
    {
        $users=User::pluck("name","id")->all();
        $permissions=Permission::pluck("name","id")->all();
        return view('backend.user-permissions.create',compact("users","permissions"));
    }

    public function permission_store(Request $request)
    {
        $requestData = $request->all();
        $user=User::FindOrFail($requestData['users']);
        $permission=Permission::FindOrFail($requestData['permissions']);
        $user->givePermissionTo($permission);
        return redirect(route('users.index'));
    }

    public function permission_delete($user_id,$permission_id)
    {
        $user=User::findOrFail($user_id);
        $user->revokePermissionTo($permission_id);
        return redirect(route('users.index'));
    }

    public function role_create()
    {
        $users=User::pluck("name","id")->all();
        $roles=Role::pluck("name","id")->all();
        return view('backend.user-roles.create',compact("users","roles"));
    }

    public function role_store(Request $request)
    {
        $requestData = $request->all();
        $user=User::FindOrFail($requestData['users']);
        $roles=Role::FindOrFail($requestData['roles']);
        $user->assignRole($roles);
        return redirect(route('users.index'));

    }

    public function role_delete($user_id,$permission_id)
    {
        $user=User::findOrFail($user_id);
        $user->removeRole($permission_id);
        return redirect(route('users.index'));
    }

}
