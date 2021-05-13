<?php

namespace App\Http\Controllers;

use App\City;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class AJAXController extends Controller
{
    //
    public function state(Request $request){


            $data = $request->input('state');

            $cities = City::where("states_id", "=", "$data")->pluck("name", "id")->all();


            return Response::json(array(
            'success' => true,
            'cities'   => $cities
            ));

    }
}
