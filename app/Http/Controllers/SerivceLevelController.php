<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceLevelRequest;
use App\Models\ServiceLevel;
use App\Models\ServiceLevelLookup;
use App\Models\ServiceLevelMaintenanceLookup;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SerivceLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $serviceLevels = ServiceLevel::get();

        // dd($serviceLevels[1]->serviceLevelMaintenance_lookups);

        Session::put('serviceLevel_url', request()->fullUrl());
        Session::forget('website_show_url');
        Session::forget('session_website_id');


        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){       
            $serviceLevels = ServiceLevel::orderBy($column, $direction)->paginate(Config('app.limit'));
        }else{
            $serviceLevels = ServiceLevel::paginate(Config('app.limit'));
        }

        return view('serviceLevel.index',[
            'serviceLevels' => $serviceLevels,
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
        return view('serviceLevel.create',[
            'serviceLevel' => new ServiceLevel,
            'websites' => Website::get(),
            'session_website_id' => Session::get('session_website_id'),
            'website_show_url' => Session::get('website_show_url'),
            'serviceLevel_url' => Session::get('serviceLevel_url'),
            'serviceLevel_lookups' => ServiceLevelLookup::get(),
            'serviceLevelMaintenance_lookups' => ServiceLevelMaintenanceLookup::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceLevelRequest $request)
    {
        $request->validated();
        ServiceLevel::create($request->except([
            '_token', '_method'
        ]));

        session()->flash('success','Service Level has been created!');

        $websiteShowUrl = Session::get('website_show_url');

        return $websiteShowUrl ? redirect($websiteShowUrl) : redirect(route('serviceLevel.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('serviceLevel.show',[
            'serviceLevel' => ServiceLevel::findOrFail($id)
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
        return view('serviceLevel.edit',[
            'serviceLevel' => ServiceLevel::findOrFail($id),
            'websites' => Website::get(),
            'website_show_url' => Session::get('website_show_url'),
            'serviceLevel_url' => Session::get('serviceLevel_url'),
            'serviceLevel_lookups' => ServiceLevelLookup::get(),
            'serviceLevelMaintenance_lookups' => ServiceLevelMaintenanceLookup::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceLevelRequest $request, $id)
    {
        $request->validated();

        ServiceLevel::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Service Level record has been updated!');

        $websiteShowUrl = Session::get('website_show_url');
        $serviceLevelUrl = Session::get('serviceLevel_url');

        if ($websiteShowUrl) {
            return redirect($websiteShowUrl);
        } elseif ($serviceLevelUrl) {
            return redirect($serviceLevelUrl);
        } else {
            return redirect(route('serviceLevel.index'));
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
        ServiceLevel::findOrFail($request->id)->delete();
        
        session()->flash('success', 'Service Level record has been deleted!');

        $websiteShowUrl = Session::get('website_show_url');
        $serviceLevelUrl = Session::get('serviceLevel_url');

        if ($websiteShowUrl) {
            return redirect($websiteShowUrl);
        } elseif ($serviceLevelUrl) {
            return redirect($serviceLevelUrl);
        } else {
            return redirect(route('serviceLevel.index'));
        }
    }
}
