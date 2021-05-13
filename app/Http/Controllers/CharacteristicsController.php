<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Characteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class CharacteristicsController extends Controller
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
            $characteristics = Characteristic::where('name', 'LIKE', "%$keyword%")
				->orWhere('chack', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $characteristics = Characteristic::paginate($perPage);
        }

        return view('backend.characteristics.index', compact('characteristics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.characteristics.create');
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
        $newsItem = new Characteristic(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->chack=$requestData["chack"];
        $newsItem->save();


        Session::flash('flash_message', 'Characteristic added!');

        return redirect(route('characteristics.index'));
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
        $characteristic = Characteristic::findOrFail($id);

        return view('backend.characteristics.show', compact('characteristic'));
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
        $characteristic = Characteristic::findOrFail($id);

        return view('backend.characteristics.edit', compact('characteristic'));
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
        $type = Characteristic::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $requestData=$request->except('name');
        $type->update($requestData);

        Session::flash('flash_message', 'Characteristic updated!');

        return redirect(route('characteristics.index'));
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
        Characteristic::destroy($id);

        Session::flash('flash_message', 'Characteristic deleted!');

        return redirect(route('characteristics.index'));
    }
}
