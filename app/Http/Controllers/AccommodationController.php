<?php

namespace App\Http\Controllers;

use App\Accomodation;
use App\Category;
use App\Characteristic;
use App\City;
use App\Distance;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Accommodation;
use App\Http\Requests\AccommodationRequest;
use App\Period;
use App\Renting;
use App\State;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    protected $perPage = 25;




    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage=$this->perPage;

        if(auth()->user()->can('edit all accommodation')) {
            if (!empty($keyword)) {

                $accommodation = $this->search($keyword);
            } else {
                $accommodation = Accommodation::paginate($perPage);
            }
        }else{
            $id = Auth::user()->id;
            if (!empty($keyword)) {
                $accommodation = $this->search($keyword, $id);
            } else {
                $accommodation = Accommodation::where("user_id", "=" ,$id)->paginate($perPage);
            }
        }

        return view('backend.accommodation.index', compact('accommodation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $languages=LaravelLocalization::getSupportedLocales();
        $period=Period::all();
        $renting=Renting::all();
        $distances=Distance::all();
        $priority=array("default"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10");
        $deposit =array("default"=>trans('accommodation.choose'),"1"=>"10%","2"=>"20%","3"=>"30%","4"=>"40%");
        $premium=array("default"=>"0","1"=>"1");
        $status=array("default"=>"1","0");
        $characteristics=Characteristic::all();

        $states= State::pluck("name","id")->all();
        $types=Type::pluck("name","id")->all();
        $categories=Category::pluck("name","id")->all();
        $users=User::pluck("name","id")->all();
        return view('backend.accommodation.create',compact("status","premium","priority","deposit","types","categories","users", "languages", "states","renting","period","distances","characteristics"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AccommodationRequest $request)
    {
        $requestData = $request->all();

        $accommodation=Accommodation::create($requestData);

        $renting = Renting::all();
        foreach ($renting as $re) {
            $re->accommodations()->detach($accommodation);
        }
        if(isset($requestData["renting"]))
        {
            foreach($requestData["renting"]as $renting)
            {
                $Renting=Renting::findOrFail($renting);
                $Renting->accommodations()->save($accommodation);
            }
        }

        $periods = Period::all();
        foreach ($periods as $pr) {
            $pr->accommodations()->detach($accommodation);
        }
        if(isset($requestData["period"]))
        {
            foreach($requestData["period"]as $period)
            {
                $Period=Period::findOrFail($period);
                $Period->accommodations()->save($accommodation);
            }
        }

        $characteristics=Characteristic::all();
        foreach ($characteristics as $ch) {
            $ch->accommodations()->detach($accommodation);
        }

        if(isset($requestData["characteristic"])  && is_array($requestData["characteristic"]))
        {

            foreach ($requestData["characteristic"]as $idcharacteristic)
            {
                $charateristic=Characteristic::findOrFail($idcharacteristic);
                $charateristic->accommodations()->save($accommodation);
            }
        }


        if(isset($requestData["idcharacteristics"]) && is_array($requestData["idcharacteristics"]))
        {
            foreach ($requestData["idcharacteristics"] as $key => $karakteristika)
            {
                foreach ($requestData["characteristics"] as $key1 =>$legenda)
                {
                    if($key1 == $key && $requestData["characteristics"]!=0)
                    {
                        $charateristics=Characteristic::findOrFail($karakteristika);
                        $charateristics->accommodations()->save($accommodation);
                    }
                }
            }
        }

//
//        $distances = Distance::all();
//        foreach ($distances as $di) {
//            $di->accommodations()->detach($accommodation);
//        }


        Session::flash('flash_message', 'Accommodation added!');

        return redirect(route('accommodation.index'))->with('flash_message', 'Accommodation added!');
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
        $accommodation = Accommodation::findOrFail($id);

        return view('backend.accommodation.show', compact('accommodation'));
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

        $accommodation = Accommodation::findOrFail($id);

        if(!auth()->user()->can('edit all accommodation')) {
            $this->authorize("update", $accommodation);
        }
        $period=Period::all();
        $renting=Renting::all();

        $accommodation_period=$accommodation->periods()->get();

        $accommodation_characteristics=$accommodation->characteristics()->get();
        $priority=array("default"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5","6"=>"6","7"=>"7","8"=>"8","9"=>"9","10"=>"10");
        $deposit =array("default"=>trans('accommodation.choose'),"1"=>"10%","2"=>"20%","3"=>"30%","4"=>"40%");
        $status=array("default"=>"1","0");
        $cities= City::pluck("name","id")->all();
        $characteristics=Characteristic::all();
        $states= State::pluck("name","id")->all();
        $types=Type::pluck("name","id")->all();
        $distances=Distance::all();
        $categories=Category::pluck("name","id")->all();
        $users=User::pluck("name","id")->all();
        $premium=array("default"=>"0","1"=>"1");

        return view('backend.accommodation.edit', compact('accommodation','accommodation_period',"cities","types","categories","users","states","deposit","renting","period","priority","premium","status","distances","characteristics"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, AccommodationRequest $request)
    {
        $accommodation = Accommodation::findOrFail($id);
        if (!auth()->user()->can('edit all accommodation')) {
            $this->authorize("update", $accommodation);
        }

        $requestData = $request->all();

        $renting = Renting::all();
        foreach ($renting as $re) {
            $re->accommodations()->detach($accommodation);
        }
        if(isset($requestData["renting"]))
        {
            foreach($requestData["renting"]as $renting)
            {
                $Renting=Renting::findOrFail($renting);
                $Renting->accommodations()->save($accommodation);
            }
        }

        $periods = Period::all();
        foreach ($periods as $pr) {
            $pr->accommodations()->detach($accommodation);
        }
        if(isset($requestData["period"]))
        {
            foreach($requestData["period"]as $period)
            {
                $Period=Period::findOrFail($period);
                $Period->accommodations()->save($accommodation);
            }
        }

        $characteristics=Characteristic::all();
        foreach ($characteristics as $ch) {
            $ch->accommodations()->detach($accommodation);
        }

        if(isset($requestData["characteristic"])  && is_array($requestData["characteristic"]))
        {

            foreach ($requestData["characteristic"]as $idcharacteristic)
            {
                $charateristic=Characteristic::findOrFail($idcharacteristic);
                $charateristic->accommodations()->save($accommodation);
            }
        }


        if(isset($requestData["idcharacteristics"]) && is_array($requestData["idcharacteristics"]))
        {
            foreach ($requestData["idcharacteristics"] as $key => $karakteristika)
            {
                foreach ($requestData["characteristics"] as $key1 =>$legenda)
                {
                    if($key1 == $key && $requestData["characteristics"]!=0)
                    {
                        $charateristics=Characteristic::findOrFail($karakteristika);
                        $charateristics->accommodations()->save($accommodation);
                    }
                }
            }
        }
        $distances = Distance::all();
        foreach ($distances as $di) {
            $di->accommodations()->detach($accommodation);
        }
        if(isset($requestData["iddistance"]) && is_array($requestData["iddistance"]))
        {
            foreach ($requestData["iddistance"] as $key1 => $idd)
            {
                if(isset($requestData["distance"]) && is_array($requestData["distance"]))
                {
                    foreach ($requestData["distance"] as $key2 => $distance)
                    {
                        if( $key2 ==  $key1)
                        {
                            $Distance=Distance::findOrFail($idd);
                            $Distance->accommodations()->sync([1 => ['distance' => $distance]]);
                        }
                    }
                }
            }
        }


        $accommodation->setTranslation("name",App::getLocale(),$requestData["name"]);
        $accommodation->setTranslation("description",App::getLocale(),$requestData["description"]);
        $requestData=$request->except('name',"description");
        $accommodation->update($requestData);

        Session::flash('flash_message', 'Accommodation updated!');

        return redirect(route('accommodation.index'));
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
        $accommodation = Accommodation::findOrFail($id);
        if(!auth()->user()->can('edit all accommodation')) {
            $this->authorize("update", $accommodation);
        }
        Accommodation::destroy($id);

        Session::flash('flash_message', 'Accommodation deleted!');

        return redirect(route('accommodation.index'));
    }

    protected function search($keyword, $id=null)
    {
        $perPage=$this->perPage;
        $accommodation = Accommodation::where('name', 'LIKE', "%$keyword%")->where("user_id", "=" ,$id)
            ->orWhereHas('city', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhereHas('user', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhereHas('type', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            })
            ->orWhere('description', 'LIKE', "%$keyword%")
            ->orWhere('capacity', 'LIKE', "%$keyword%")
            ->orWhere('deposit', 'LIKE', "%$keyword%")
            ->orWhere('longitude', 'LIKE', "%$keyword%")
            ->orWhere('latitude', 'LIKE', "%$keyword%")
            ->orWhere('website', 'LIKE', "%$keyword%")
            ->orWhere('address', 'LIKE', "%$keyword%")
            ->orWhere('youtube_link', 'LIKE', "%$keyword%")
            ->orWhere('priority', 'LIKE', "%$keyword%")
            ->orWhere('premium', 'LIKE', "%$keyword%")
            ->orWhere('status', 'LIKE', "%$keyword%")
            ->orWhere('views', 'LIKE', "%$keyword%")
            ->paginate($perPage);
        return $accommodation;
    }
}
