<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\City;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class CityController extends Controller
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
            $city = City::where('name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $city = City::paginate($perPage);
        }

        return view('backend.city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $state= State::pluck("name","id")->all();
        return view('backend.city.create',compact('state'));
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
        $this->validate($request, [
            'name' => 'min:5|max:30|required',
            'states_id' => 'required|integer',
            'path' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'zoom' => 'required|string',
            'status' => 'required|integer'
        ]);
        $requestData = $request->all();
        $newsItem = new City(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->setTranslation('path',App::getLocale(),$requestData["path"]);
        $newsItem->states_id=$requestData['states_id'];
        $newsItem->zoom=$requestData['zoom'];
        $newsItem->longitude=$requestData['longitude'];
        $newsItem->latitude=$requestData['latitude'];
        $newsItem->status=$requestData['status'];
        $newsItem->save();


        Session::flash('flash_message', 'City added!');

        return redirect(route('city.index'));
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
        $city = City::findOrFail($id);

        return view('backend.city.show', compact('city'));
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
        $city = City::findOrFail($id);
        $state= State::pluck("name","id")->all();
        return view('backend.city.edit', compact('city',"state"));
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
        $this->validate($request, [
            'name' => 'min:5|max:30|required',
            'states_id' => 'required|integer',
            'path' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'zoom' => 'required|string',
            'status' => 'required|integer'
        ]);
        $requestData = $request->all();
        $type = City::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $type->setTranslation("path",App::getLocale(),$requestData["path"]);
        $requestData=$request->except('name',"path");
        $type->update($requestData);

        Session::flash('flash_message', 'City updated!');

        return redirect(route('city.index'));
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
        City::destroy($id);

        Session::flash('flash_message', 'City deleted!');

        return redirect(route('city.index'));
    }
}
