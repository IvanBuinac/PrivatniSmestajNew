<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class DistanceController extends Controller
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
            $distance = Distance::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $distance = Distance::paginate($perPage);
        }

        return view('backend.distance.index', compact('distance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.distance.create');
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
			'name' => 'min:5|max:30|required'
		]);
        $requestData = $request->all();
        $newsItem = new Distance(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->save();

        Session::flash('flash_message', 'Distance added!');

        return redirect(route('distance.index'));
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
        $distance = Distance::findOrFail($id);

        return view('backend.distance.show', compact('distance'));
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
        $distance = Distance::findOrFail($id);

        return view('backend.distance.edit', compact('distance'));
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
			'name' => 'min:5|max:30|required'
		]);
        $requestData = $request->all();
        $type = Distance::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $type->update($requestData);

        Session::flash('flash_message', 'Distance updated!');

        return redirect(route('distance.index'));
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
        Distance::destroy($id);

        Session::flash('flash_message', 'Distance deleted!');

        return redirect(route('distance.index'));
    }
}
