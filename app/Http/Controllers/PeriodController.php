<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Session;

class PeriodController extends Controller
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
            $period = Period::where('name', 'LIKE', "%$keyword%")
				->orWhere('picture', 'LIKE', "%$keyword%")
				
                ->paginate($perPage);
        } else {
            $period = Period::paginate($perPage);
        }

        return view('backend.period.index', compact('period'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.period.create');
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
			'name' => 'min:4|max:30|required',
			'picture' => 'required'
		]);
        $requestData = $request->all();
        $newsItem = new Period(); // This is an Eloquent model
        $newsItem->setTranslation('name',App::getLocale(),$requestData["name"]);
        $newsItem->picture=$requestData["picture"];
        $newsItem->save();

        Session::flash('flash_message', 'Period added!');

        return redirect(route('period.index'));
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
        $period = Period::findOrFail($id);

        return view('backend.period.show', compact('period'));
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
        $period = Period::findOrFail($id);

        return view('backend.period.edit', compact('period'));
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
			'name' => 'min:4|max:30|required',
			'picture' => 'required'
		]);
        $requestData = $request->all();
        $type = Period::findOrFail($id);
        $type->setTranslation("name",App::getLocale(),$requestData["name"]);
        $type->picture=$requestData["picture"];
        $requestData=$request->except('name');
        $type->update($requestData);

        Session::flash('flash_message', 'Period updated!');

        return redirect(route('period.index'));
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
        Period::destroy($id);

        Session::flash('flash_message', 'Period deleted!');

        return redirect(route('period.index'));
    }
}
