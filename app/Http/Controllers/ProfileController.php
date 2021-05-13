<?php

namespace App\Http\Controllers;

use App\City;
use App\Http\Requests\ProfileRequest;
use App\State;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Null_;


class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $states= State::pluck("name","id")->all();
        $cityy=City::findOrFail($user->city_id);
        $city=$cityy->pluck("id");
        $statess=State::findOrFail($cityy->states_id);
        $state=$statess->pluck("id");
        $citissssss=$statess->cities->pluck("name","id")->all();


        return view('user.profile.index', compact('user','states','state',"city","citissssss"));
    }

    public function update ($id, ProfileRequest $request)
    {
        $logout=false;

        if (trim($request->password) == "") {
            $requestData = $request->except("password");
        } else {
        $logout=true;
        $requestData = $request->all();
        $requestData["password"]=bcrypt($request->password);
        }

        $user = User::findOrFail($id);

        if($file = $request->file("photo"))
        {
            $path=storage_path()."/app/public/images/users/$user->name/";
            if (!file_exists($path)) {
                mkdir($path,0777, true);
            }
            $extension=$file->getClientOriginalExtension();

            $image_name = $user->name;

            $image = Image::make($_FILES['photo']['tmp_name'])->save($path."".$image_name.".".$extension);


//
            $image->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
//
            $image->insert(storage_path()."/app/public/images/logos/PrivatniSmestaj-mini.png");
//
            $image->save($path."".$image_name.".".$extension);
//
//
//
//
//
            $requestData["photo"]=$image_name.".".$extension;
        }

        if($request->email!=$user->email)
        {
            $logout=true;
        }


        $user->update($requestData);

        if($logout==true)
        {
            Auth::logout();
        }

        Session::flash('flash_message', 'User updated!');


        return redirect()->action('ProfileController@index');

    }

}
