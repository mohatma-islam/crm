<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $clients = Client::filter(request(['search']));

        Session::forget('client_show_url');
        Session::forget('client_url');
        Session::put('client_url', request()->fullUrl());

        $getUser = $request->user;
        $direction = 'asc';
        $column = $request->get('column');
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if ($getUser != "") {
            $clients = $clients->where('client_account_manager_id', $getUser);
        }

        if ($column != "") {
            $clients = $clients->orderBy($column, $direction);
        }

        $clients = $clients->paginate(Config('app.limit'));

        return view('client.index', [
            'clients' => $clients,
            'users' => User::select('id', 'user_name')->get(),
            'direction' => $direction,
            'column' => $column,
            'selectedUser' => $getUser
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create', [
            'client' => new Client(),
            'client_url' => Session::get('client_url')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $request->validated();

        Client::create($request->except([
            '_token', '_method' , 'query_string'
        ]));

        session()->flash('success', 'New Client record has been created!');

        return redirect(route('client.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);

        $color = "";
        if ($client->deal != null) {
            if ($client->deal->deal_stage_lookup->value == 'New') {
                $color = 'primary';
            } elseif ($client->deal->deal_stage_lookup->value == 'Proposal') {
                $color = 'info';
            } elseif ($client->deal->deal_stage_lookup->value == 'Negotiation') {
                $color = 'warning';
            } elseif ($client->deal->deal_stage_lookup->value == 'Won') {
                $color = 'success';
            } else {
                $color = 'danger';
            }
        }

        $totalHostingDetails = 0;

        //counting the number of hostingDetails
        foreach ($client->websites as $website) {
            if ($website->hostingDetail) {
                $totalHostingDetails++;
            }
        }

        $response = Http::withToken(config('services.forgeLaravelToken.api_token'))
            ->get('https://forge.laravel.com/api/v1/servers');

        Session::forget('client_show_url');
        Session::put('client_show_url', request()->fullUrl());

        Session::forget('session_client_id');
        Session::put('session_client_id', $id);

        $clientUrl = Session::get('client_url');

        return view('client.show', [
            'client' => $client,
            'totalHostingDetails' => $totalHostingDetails,
            'clientUrl' => $clientUrl,
            'serverDetails' => $response->json(),
            'color' => $color
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
        return view('client.edit', [
            'client' => Client::findOrFail($id),
            'client_url' => Session::get('client_url')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $request->validated();

        Client::where('id', $id)->update($request->except([
            '_token', '_method', 'query_string'
        ]));

        session()->flash('success', 'Client record has been updated!');

        if (session('client_url')) {
            return redirect(session('client_url'));
        }
        return redirect(route('client.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client = Client::findOrFail($request->id);

        $deal = $client->deal()->delete();
        $websites = $client->websites()->delete();
        $contacts = $client->clientContacts()->delete();
        $activities = $client->activities()->delete();
        $transactions = $client->transactions()->delete();

        $client->delete();

        session()
            ->flash('success', 'Client record has been deleted! <br><br>
        Associate Deal, Transactions, Contacts, Websites and Activities has also been
         deleted! </br>');

        if (session('client_url')) {
            return redirect(session('client_url'));
        }

        return redirect(route('client.index'));
    }

    public function exportClients()
    {
        $clients = Client::with('user', 'clientContacts')->get();

        $filePath = storage_path('app/clients.csv');
        $file = fopen($filePath, 'w');

        fputcsv($file, [
            'Client ID',
            'Client Name',
            'Account Manager',
            'Address',

            //Client Contacts Details

            'Contact ID',
            'Contact Primary Contact',
            'Contact Name',
            'Contact Email',
            'Contact Phone Number',

            //Websites

            'Website ID',
            'Website Name',
            'Website Address',

            //Hosting

            'Hosting ID',
            'Hosting Name',

        ]);

        foreach ($clients as $client) {

            //Client Contacts

            $clientContactId = "";
            $clientPrimaryContact = "";
            $clientContactName = "";
            $clientContactEmail = "";
            $clientContactPhoneNumber = "";

            //Websites
            $websiteID = "";
            $websiteName = "";
            $websiteAddress = "";

            //Hosting
            $hostingID = "";
            $hostingName = "";

            //Client Contacts Details

            foreach ($client->clientContacts as $clientContact) {
                $clientContactId .= $clientContact->id . " , \n\n";

                if ($clientContact->client_primary_contact == 1) {
                    $clientPrimaryContact .= 'Yes' . " , \n\n";
                } else {

                    $clientPrimaryContact .= 'No' . " , \n\n";
                }

                $clientContactName .=  $clientContact->client_contact_first_name . ' ' . $clientContact->client_contact_surname . " , \n\n";

                $clientContactEmail .= $clientContact->client_email_address . " , \n\n";

                $clientContactPhoneNumber .= $clientContact->client_phone_number . " , \n\n";
            }



            foreach ($client->websites as $website) {

                $websiteID .= $website->id . " , \n\n";
                $websiteName .= $website->website_name . " , \n\n";
                $websiteAddress .= $website->website_address . " , \n\n";

                if ($website->hostingDetail != null) {
                    $hostingID .= $website->hostingDetail->id . " , \n\n";
                    $hostingName .= $website->hostingDetail->host_name . " , \n\n";
                }
            }

            fputcsv($file, [

                $client->id,
                $client->client_name,
                $client->user->user_name,
                $client->client_postal_address,

                //Client Contacts Details

                ltrim(rtrim($clientContactId, " , \n\n")),
                ltrim(rtrim($clientPrimaryContact, " , \n\n")),
                ltrim(rtrim($clientContactName, " , \n\n")),
                ltrim(rtrim($clientContactEmail, " , \n\n")),
                ltrim(rtrim($clientContactPhoneNumber, " , \n\n")),

                //Websites
                ltrim(rtrim($websiteID, " , \n\n")),
                ltrim(rtrim($websiteName, " , \n\n")),
                ltrim(rtrim($websiteAddress, " , \n\n")),

                ltrim(rtrim($hostingID, " , \n\n")),
                ltrim(rtrim($hostingName, " , \n\n")),


            ]);
        }

        fclose($file);

        return response()->download($filePath);
    }
}
