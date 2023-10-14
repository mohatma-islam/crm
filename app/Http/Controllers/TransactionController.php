<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        Session::forget('client_show_url');
        Session::forget('transaction_url');
        Session::forget('session_client_id');
        Session::put('transaction_url', request()->fullUrl());

        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){       
            $transactions = Transaction::orderBy($column, $direction)->paginate(Config('app.limit'));
        }else{
            $transactions = Transaction::paginate(Config('app.limit'));
        }

        return view('transaction.index',[
            'transactions' => $transactions,
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
        return view('transaction.create', [
            'transaction' => new Transaction(),
            'clients' => Client::select('id', 'client_name')->get(),
            'session_client_id' => Session::get('session_client_id'),
            'client_show_url' => Session::get('client_show_url'),
            'transaction_url' => Session::get('transaction_url')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $request->validated();

        Transaction::create($request->except([
            '_token', '_method'
        ]));

        session()->flash('success','Transaction record has been created!');

        $clientShowUrl = Session::get('client_show_url');

        return $clientShowUrl ? redirect($clientShowUrl) : redirect(route('transaction.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return view('transaction.show',[
            'transaction' => Transaction::findOrFail($id)
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
        return view('transaction.edit',[
            'transaction' => Transaction::findOrFail($id),
            'clients' => Client::select('id', 'client_name')->get(),
            'client_show_url' => Session::get('client_show_url'),
            'transaction_url' => Session::get('transaction_url'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $request->validated();
       
        Transaction::where('id', $id)->update($request->except([
            '_token', '_method'
        ]));

        session()->flash('success', 'Transaction record has been updated!');

        $clientShowUrl = Session::get('client_show_url');
        $transactionUrl = Session::get('transaction_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($transactionUrl) {
            return redirect($transactionUrl);
        } else {
            return redirect(route('transaction.index'));
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
        Transaction::findOrFail($request->id)->delete();

        session()->flash('success', 'Transaction record has been deleted!');

        $clientShowUrl = Session::get('client_show_url');
        $transactionUrl = Session::get('transaction_url');

        if ($clientShowUrl) {
            return redirect($clientShowUrl);
        } elseif ($transactionUrl) {
            return redirect($transactionUrl);
        } else {
            return redirect(route('transaction.index'));
        }
        
    }
}
