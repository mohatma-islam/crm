<?php

namespace App\Http\Controllers;

use App\Http\Requests\TechnologyRequest;
use App\Models\Technology;
use App\Models\TechnologyLookup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::put('technology_url', request()->fullUrl());
        Session::forget('website_show_url');
        Session::forget('session_website_id');

        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){       
            $technologies = Technology::orderBy($column, $direction)->paginate(Config('app.limit'));
        }else{
            $technologies = Technology::paginate(Config('app.limit'));
        }

        return view('technology.index',[
            'technologies' => $technologies,
            'direction' => $direction,
            'column' => $column
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       return view('technology.create',[
            'technology' => new Technology(),
            'session_website_id' => Session::get('session_website_id'),
            'website_show_url' => Session::get('website_show_url'),
            'technolog_url' => Session::get('technology_url'),
            'technology_lookups' => TechnologyLookup::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TechnologyRequest $request)
    {
        $request->validated();

        Technology::create($request->except([
            '_token', '_method'
        ]));

        session()->flash('success','Technology record has been created!');

        $websiteShowUrl = Session::get('website_show_url');

        return $websiteShowUrl ? redirect($websiteShowUrl) : redirect(route('technology.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('technology.show',[
            'technology' => Technology::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('technology.edit',[
            'technology' => Technology::findOrFail($id),
            'website_show_url' => Session::get('website_show_url'),
            'technolog_url' => Session::get('technology_url'),
            'technology_lookups' => TechnologyLookup::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TechnologyRequest $request, $id)
    {
        $request->validated();
       
        Technology::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Technology record has been updated!');

        $websiteShowUrl = Session::get('website_show_url');
        $technologyUrl = Session::get('technology_url');

        if ($websiteShowUrl) {
            return redirect($websiteShowUrl);
        } elseif ($technologyUrl) {
            return redirect($technologyUrl);
        } else {
            return redirect(route('technology.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Technology::findOrFail($request->id)->delete();

        session()->flash('success', 'Technology record has been deleted!');

        $websiteShowUrl = Session::get('website_show_url');
        $technologyUrl = Session::get('technology_url');

        if ($websiteShowUrl) {
            return redirect($websiteShowUrl);
        } elseif ($technologyUrl) {
            return redirect($technologyUrl);
        } else {
            return redirect(route('technology.index'));
        }
    }
}
