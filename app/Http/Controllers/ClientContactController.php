<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientContactRequest;
use App\Models\Activity;
use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Session::forget('client_show_url');
        Session::forget('clientContact_url');
        Session::forget('session_client_id');
        Session::put('clientContact_url', request()->fullUrl());

        $clientContacts = ClientContact::filter(request(['search']));


        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){
            $clientContacts = $clientContacts->orderBy($column, $direction);
        }

        $clientContacts = $clientContacts->paginate(Config('app.limit'));

        return view('clientContact.index', [
            'clientContacts' =>  $clientContacts,
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
        return view('clientContact.create', [
            'clientContact' => new ClientContact(),
            'session_client_id' => Session::get('session_client_id'),
            'client_show_url' => Session::get('client_show_url'),
            'clientContact_url' => Session::get('clientContact_url')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientContactRequest $request)
    {
        $request->validated();

        $clientContact = ClientContact::create([
            'client_id' => $request->client_id,
            'client_primary_contact' => $request->boolean('client_primary_contact'),
            'client_contact_first_name' => $request->client_contact_first_name,
            'client_contact_surname' => $request->client_contact_surname,
            'client_email_address' => $request->client_email_address,
            'client_phone_number' => $request->client_phone_number
        ]);

        $clientContact->save();

        // create a activity object when new website is created
        Activity::create([
            'client_id' => $request->client_id,
            'activity_type' => 'Client Contact Record Created',
            'activity_description' => $request->client_contact_first_name . ' ' . $request->client_contact_surname . ' record has been created',
            'created_by_id' => $request->created_by_id
        ]);

        session()->flash('success', 'Client Contact record has been created!');

        $clientShowUrl = Session::get('client_show_url');

        return $clientShowUrl ? redirect($clientShowUrl) : redirect(route('clientContact.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {    
        return view('clientContact.show', [
            'clientContact' => ClientContact::findOrFail($id)
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
        return view('clientContact.edit', [
            'clientContact' => ClientContact::findOrFail($id),
            'client_show_url' => Session::get('client_show_url'),
            'clientContact_url' => Session::get('clientContact_url')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientContactRequest $request, $id)
    {
        $request->validated();

        ClientContact::where('id', $id)->update([
            'client_id' => $request->client_id,
            'client_primary_contact' => $request->boolean('client_primary_contact'),
            'client_contact_first_name' => $request->client_contact_first_name,
            'client_contact_surname' => $request->client_contact_surname,
            'client_email_address' => $request->client_email_address,
            'client_phone_number' => $request->client_phone_number
        ]);


        session()->flash('success', 'Client Contact record has been updated!');

        $clientShowUrl = Session::get('client_show_url');
        $clientContactUrl = Session::get('clientContact_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($clientContactUrl) {
            return redirect($clientContactUrl);
        } else {
            return redirect(route('clientContact.index'));
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
        ClientContact::findOrFail($request->id)->delete();

        session()->flash('success', 'Client Contact record has been deleted!');

        $clientShowUrl = Session::get('client_show_url');
        $clientContactUrl = Session::get('clientContact_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($clientContactUrl) {
            return redirect($clientContactUrl);
        } else {
            return redirect(route('clientContact.index'));
        }
    }

}
