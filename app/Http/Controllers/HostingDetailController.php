<?php

namespace App\Http\Controllers;

use App\Http\Requests\HostingDetailRequest;
use App\Models\ConnectionTypeLookup;
use App\Models\HostingDetail;
use App\Models\ServerSupplierLookup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\Pool;
use Laravel\Ui\Presets\React;

class HostingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::forget('client_show_url');
        Session::forget('hostingDetail_url');
        Session::forget('website_show_url');
        Session::put('hostingDetail_url', request()->fullUrl());


        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){       
            $hostingDetails = HostingDetail::orderBy($column, $direction)->paginate(Config('app.limit'));
        }else{
            $hostingDetails = HostingDetail::paginate(Config('app.limit'));
        }

        return view('hostingDetail.index', [
            'hostingDetails' => $hostingDetails,
            'serverDetails' => $this->forgeApi(),
            'direction' => $direction,
            'column' => $column
        ]);

    }

    public function server($id){

        $responses = Http::pool(fn (Pool $pool) => [
            $pool->as('servers')->withToken(config('services.forgeLaravelToken.api_token'))->get('https://forge.laravel.com/api/v1/servers/'.$id),
            $pool->as('sites')->withToken(config('services.forgeLaravelToken.api_token'))->get('https://forge.laravel.com/api/v1/servers/'.$id.'/sites'),
        ]);

        return view('hostingDetail.server', [
            'serverDetail' => $responses['servers']->json(),
            'sites' => $responses['sites']->json() 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hostingDetail.create', [
            'hostingDetail' => new HostingDetail(),
            'serverDetails' => $this->forgeApi(),
            'session_website_id' => Session::get('session_website_id'),
            'website_show_url' => Session::get('website_show_url'),
            'hostingDetail_url' => Session::get('hostingDetail_url'),
            'server_supplier_lookups' => ServerSupplierLookup::get(),
            'connection_type_lookups' => ConnectionTypeLookup::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HostingDetailRequest $request)
    {
        $request->validated();

        HostingDetail::create($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Hosting Detail has been created!');

        $websiteShowUrl = Session::get('website_show_url');

        return $websiteShowUrl ? redirect($websiteShowUrl) : redirect(route('hostingDetail.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('hostingDetail.show', [
            'hostingDetail' => HostingDetail::findOrFail($id),
            'serverDetails' => $this->forgeApi(),
            'clientShowUrl' => Session::get('client_show_url'),
            'websiteShowUrl' => Session::get('website_show_url'),
            'hostingDetaillUrl' => Session::get('hostingDetail_url'),
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
        return view('hostingDetail.edit', [
            'hostingDetail' => HostingDetail::findOrFail($id),
            'serverDetails' => $this->forgeApi(),
            'website_show_url' => Session::get('website_show_url'),
            'hostingDetail_url' => Session::get('hostingDetail_url'),
            'server_supplier_lookups' => ServerSupplierLookup::get(),
            'connection_type_lookups' => ConnectionTypeLookup::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HostingDetailRequest $request, $id)
    {
        $request->validated();

        $hostingDetail = HostingDetail::findOrFail($id);
    
        $data = $request->except(['_token', '_method']);
    
        $hostingDetail->update($data);

        session()->flash('success', 'Hosting Detail record has been updated!');
        
        $websiteShowUrl = Session::get('website_show_url');
        $clientShowlUrl = Session::get('client_show_url');
        $hostingDetaillUrl = Session::get('hostingDetail_url');

        return $websiteShowUrl ? redirect($websiteShowUrl) : 
        ($clientShowlUrl ? redirect($clientShowlUrl) : 
        ($hostingDetaillUrl ? redirect($hostingDetaillUrl) : redirect(route('hostingDetail.index'))
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        HostingDetail::findOrFail($request->id)->delete();

        session()->flash('success', 'Hosting Detail record has been deleted!');

        $websiteShowUrl = Session::get('website_show_url');
        $clientShowlUrl = Session::get('client_show_url');
        $hostingDetaillUrl = Session::get('hostingDetail_url');

        return $websiteShowUrl ? redirect($websiteShowUrl) : 
        ($clientShowlUrl ? redirect($clientShowlUrl) : 
        ($hostingDetaillUrl ? redirect($hostingDetaillUrl) : redirect(route('hostingDetail.index'))
        ));
    }

    private function forgeApi(){
        $response = Http::
        withToken(config('services.forgeLaravelToken.api_token'))
        ->get('https://forge.laravel.com/api/v1/servers');

        return $response->json();
    }
}
