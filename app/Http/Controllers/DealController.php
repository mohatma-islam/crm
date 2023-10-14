<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealRequest;
use App\Models\Client;
use App\Models\Deal;
use App\Models\DealStageLookup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DealController extends Controller
{
    public function index(Request $request)
    {
        // $deals = Deal::get();

        Session::forget('client_show_url');
        Session::forget('deal_url');
        Session::forget('session_client_id');
        Session::put('deal_url', request()->fullUrl());

        $getDealStage = $request->deal_stage;
        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($getDealStage != ""){
            $deals = Deal::where('deal_stage_id', $getDealStage)->paginate(Config('app.limit'));
        }else if($column != ""){       
            $deals = Deal::orderBy($column, $direction)->paginate(Config('app.limit'));
        }else{
            $deals = Deal::paginate(Config('app.limit'));
        }

        return view('deal.index',[
            'deals' => $deals,
            'direction' => $direction,
            'column' => $column,
            'deal_stages' => DealStageLookup::get(),
            'selectedDealStage' => $getDealStage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('deal.create', [
            'deal' => new Deal(),
            'clients' => Client::select('id', 'client_name')->get(),
            'session_client_id' => Session::get('session_client_id'),
            'client_show_url' => Session::get('client_show_url'),
            'deal_url' => Session::get('deal_url'),
            'deal_stage_lookups' => DealStageLookup::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DealRequest $request)
    {
        $request->validated();

        Deal::create($request->except([
            '_token', '_method'
        ]));

        session()->flash('success','Deal record has been created!');

        $clientShowUrl = Session::get('client_show_url');
        
        return $clientShowUrl ? redirect($clientShowUrl) : redirect(route('deal.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('deal.show',[
            'deal' => Deal::findOrFail($id)
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
        return view('deal.edit',[
            'deal' => Deal::findOrFail($id),
            'clients' => Client::select('id', 'client_name')->get(),
            'client_url' => Session::get('client_url'),
            'client_show_url' => Session::get('client_show_url'),
            'deal_url' => Session::get('deal_url'),
            'deal_stage_lookups' => DealStageLookup::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DealRequest $request, $id)
    {
        $request->validated();
       
        Deal::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Deal record has been updated!');

        $clientUrl = Session::get('client_url');
        $clientShowUrl = Session::get('client_show_url');
        $dealUrl = Session::get('deal_url');

        if($clientShowUrl){
            return redirect($clientShowUrl);
        }elseif ($clientUrl) {
            return redirect($clientUrl);
        } elseif ($dealUrl) {
            return redirect($dealUrl);
        } else {
            return redirect(route('deal.index'));
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
        Deal::findOrFail($request->id)->delete();

        session()->flash('success', 'Deal record has been deleted!');
        
        $clientUrl = Session::get('client_url');
        $clientShowUrl = Session::get('client_show_url');
        $dealUrl = Session::get('deal_url');

        if($clientShowUrl){
            return redirect($clientShowUrl);
        }elseif ($clientUrl) {
            return redirect($clientUrl);
        } elseif ($dealUrl) {
            return redirect($dealUrl);
        } else {
            return redirect(route('deal.index'));
        }
    }
}
