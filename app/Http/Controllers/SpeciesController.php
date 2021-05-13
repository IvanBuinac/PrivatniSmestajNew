<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Species;
use Illuminate\Http\Request;
use Session;

class SpeciesController extends Controller
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
            $species = Species::where('name', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $species = Species::paginate($perPage);
        }

        return view('backend.species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.species.create');
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
        
        Species::create($requestData);

        Session::flash('flash_message', 'Species added!');

        return redirect(route('species.index'));
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
        $species = Species::findOrFail($id);

        return view('backend.species.show', compact('species'));
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
        $species = Species::findOrFail($id);

        return view('backend.species.edit', compact('species'));
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
        
        $species = Species::findOrFail($id);
        $species->update($requestData);

        Session::flash('flash_message', 'Species updated!');

        return redirect(route('species.index'));
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
        Species::destroy($id);

        Session::flash('flash_message', 'Species deleted!');

        return redirect(route('species.index'));
    }
}
