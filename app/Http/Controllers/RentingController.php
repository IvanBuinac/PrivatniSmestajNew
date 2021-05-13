<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Renting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class RentingController extends Controller
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
            $renting = Renting::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $renting = Renting::paginate($perPage);
        }

        return view('backend.renting.index', compact('renting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.renting.create');
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
			'name' => 'min:4|max:30|required'
		]);;
        $requestData = $request->all();
        $newsItem = new Renting(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->save();

        Session::flash('flash_message', 'Renting added!');

        return redirect(route('renting.index'));
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
        $renting = Renting::findOrFail($id);

        return view('backend.renting.show', compact('renting'));
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
        $renting = Renting::findOrFail($id);

        return view('backend.renting.edit', compact('renting'));
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
			'name' => 'min:4|max:30|required'
		]);
        $requestData = $request->all();
        $type = Renting::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $requestData=$request->except('name');
        $type->update($requestData);

        Session::flash('flash_message', 'Renting updated!');

        return redirect(route('renting.index'));
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
        Renting::destroy($id);

        Session::flash('flash_message', 'Renting deleted!');

        return redirect(route('renting.index'));
    }
}
