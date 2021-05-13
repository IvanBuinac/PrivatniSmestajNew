<?php

namespace App\Http\Controllers;

use App\Accommodation;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AccommodationUnit;
use App\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccommodationUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    protected $perPage=25;

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage =$this->perPage;

        if(auth()->user()->can('edit all accommodation units')) {
            if (!empty($keyword)) {
                $accommodationunit= $this->search($keyword);
            } else {
                $accommodationunit = AccommodationUnit::paginate($perPage);
            }
        }
        else
        {
            $id = Auth::user()->id;
            if (!empty($keyword)) {
                $accommodationunit = $this->search($keyword);
            } else {
                $accommodationunit = AccommodationUnit::paginate($perPage);
            }
        }


        return view('backend.accommodation-unit.index', compact('accommodationunit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $accommodations=Accommodation::pluck("name","id")->all();
        $species=Species::pluck("name","id")->all();

        return view('backend.accommodation-unit.create', compact("accommodations","species"));
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
			'accommodation_id' => 'required|integer',
			'description' => 'required',
			'space_number' => 'required|integer',
			'species_id' => 'required|integer'
		]);
        $requestData = $request->all();
        
        AccommodationUnit::create($requestData);

        return redirect(route('accommodation-unit.index'))->with('flash_message', 'AccommodationUnit added!');
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
        $accommodationunit = AccommodationUnit::findOrFail($id);

        return view('backend.accommodation-unit.show', compact('accommodationunit'));
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
        $accommodationunit = AccommodationUnit::findOrFail($id);

        return view('backend.accommodation-unit.edit', compact('accommodationunit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'min:5|max:30|required',
			'accommodation_id' => 'required|integer',
			'description' => 'required',
			'space_number' => 'required|integer',
			'species_id' => 'required|integer'
		]);
        $requestData = $request->all();
        
        $accommodationunit = AccommodationUnit::findOrFail($id);
        $accommodationunit->update($requestData);

        return redirect('accommodation-unit')->with('flash_message', 'AccommodationUnit updated!');
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
        AccommodationUnit::destroy($id);

        return redirect('accommodation-unit')->with('flash_message', 'AccommodationUnit deleted!');
    }

    protected function search($keyword)
    {
        $perPage =$this->perPage;
        $accommodationunit = AccommodationUnit::where('name', 'LIKE', "%$keyword%")
            ->orWhereHas('accommodation', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->orWhere('space_number', 'LIKE', "%$keyword%")
            ->orWhereHas('species', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->paginate($perPage);

        return $accommodationunit;
    }
}
