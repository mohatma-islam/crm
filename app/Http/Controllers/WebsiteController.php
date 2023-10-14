<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebsiteRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::forget('client_show_url');
        Session::forget('website_url');
        Session::forget('session_client_id');
        Session::put('website_url', request()->fullUrl());

        $websites = Website::filter(request(['search']));

        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){       
            $websites = $websites->orderBy($column, $direction);
        }
        
        $websites = $websites->paginate(Config('app.limit'));

        return view('website.index',[
            'websites' => $websites,
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
        $session_client_id = Session::get('session_client_id');

        return view('website.create',[
            'website' => new Website(),
            'session_client_id' => $session_client_id,
            'client_show_url' => Session::get('client_show_url'),
            'website_url' => Session::get('website_url')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WebsiteRequest $request)
    {
        $request->validated();

        Website::create($request->except([
            '_token', 'created_by_id'
        ]));

        // create a activity object when new website is created
        Activity::create([
            'client_id' => $request->client_id,
            'activity_type' => 'Website Record Created',
            'activity_description' => $request->website_name . ' website record has been added for client',
            'created_by_id' => $request->created_by_id
        ]);

        session()->flash('success','Website: ( ' . $request->website_address .' ) has been created!');

        $clientShowUrl = Session::get('client_show_url');

        return $clientShowUrl ? redirect($clientShowUrl) : redirect(route('website.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Session::forget('website_show_url');
        Session::put('website_show_url', request()->fullUrl());

        Session::forget('session_website_id');
        Session::put('session_website_id', $id);

         return view('website.show',[
            'website' => Website::findOrFail($id),
            'client_show_url' => Session::get('client_show_url'),
            'website_url' => Session::get('website_url')
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
        return view('website.edit',[
            'website' => Website::findOrFail($id),
            'client_show_url' => Session::get('client_show_url'),
            'website_url' => Session::get('website_url')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WebsiteRequest $request, $id)
    {
        $request->validated();

        Website::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Website record has been updated!');

        $clientShowUrl = Session::get('client_show_url');
        $websiteUrl = Session::get('website_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($websiteUrl) {
            return redirect($websiteUrl);
        } else {
            return redirect(route('website.index'));
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
        $website = Website::findOrFail($request->id);

        $hostingDetail = $website->hostingDetail()->delete();
        $serviceLevels = $website->serviceLevels()->delete();
        $technologies = $website->technologies()->delete();

        $website->delete();
        
        session()->flash('success', 'Website record has been deleted! <br><br>
        Associate Hosting Detail, Service Details and Technologies has also been
        deleted! ');

        $clientShowUrl = Session::get('client_show_url');
        $websiteUrl = Session::get('website_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($websiteUrl) {
            return redirect($websiteUrl);
        } else {
            return redirect(route('website.index'));
        }
    }
}
