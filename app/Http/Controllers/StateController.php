<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class StateController extends Controller
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
            $state = State::where('name', 'LIKE', "%$keyword%")
				->orWhere('path', 'LIKE', "%$keyword%")
				->orWhere('latitude', 'LIKE', "%$keyword%")
				->orWhere('longitude', 'LIKE', "%$keyword%")
				->orWhere('zoom', 'LIKE', "%$keyword%")
				->orWhere('status', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $state = State::paginate($perPage);
        }

        return view('backend.state.index', compact('state'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.state.create');
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
			'path' => 'required|string',
			'latitude' => 'required|string',
			'longitude' => 'required|string',
			'zoom' => 'required|string',
			'status' => 'required|integer'
		]);
        $requestData = $request->all();
        $newsItem = new State(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->setTranslation('path',App::getLocale(),$requestData["path"]);
        $newsItem->zoom=$requestData['zoom'];
        $newsItem->longitude=$requestData['longitude'];
        $newsItem->latitude=$requestData['latitude'];
        $newsItem->status=$requestData['status'];
        $newsItem->save();

        Session::flash('flash_message', 'State added!');

        return redirect(route('state.index'));
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
        $state = State::findOrFail($id);

        return view('backend.state.show', compact('state'));
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
        $state = State::findOrFail($id);

        return view('backend.state.edit', compact('state'));
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
			'path' => 'required|string',
			'latitude' => 'required|string',
			'longitude' => 'required|string',
			'zoom' => 'required|string',
			'status' => 'required|integer'
		]);
        $requestData = $request->all();
        $type = State::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $type->setTranslation("path",App::getLocale(),$requestData["path"]);
        $requestData=$request->except('name',"path");
        $type->update($requestData);


        Session::flash('flash_message', 'State updated!');

        return redirect(route('state.index'));
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
        State::destroy($id);

        Session::flash('flash_message', 'State deleted!');

        return redirect(route('state.index'));
    }
}
