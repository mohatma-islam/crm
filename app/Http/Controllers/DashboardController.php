<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Deal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $allTransactions = Transaction::query()
        ->selectRaw('Sum(amount) as sum')
        ->first();

        $allClients = Client::query()
        ->selectRaw('count(*) as count')
        ->first();
        
        //Total Deals Won
        $allDeals = Deal::get();
        $dealsWonWorth = Deal::where('deal_stage_id', 4)->sum('estimated_deal');
        
        $dealsWonCount = 0;

        foreach($allDeals as $deal){
            if($deal->deal_stage_id == 4){
                $dealsWonCount ++;
            }
        }
        

        return view('dashboard',[

            'allTransactions' => $allTransactions,
            'allClients' => $allClients,
            'dealsWonCount' => $dealsWonCount,
            'dealsWonWorth' => $dealsWonWorth,
        ]);
    }


    public function showTransaction(Request $request){

        $yearValue = $request->input('yearValue') ?? date('Y');

        $transactions = Transaction::query()
            ->whereYear('created_at', $yearValue)
            ->selectRaw('month(created_at) as month')
            ->selectRaw('Sum(amount) as sum')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        $totalTransactionsWithMonth = [];
        $totalAmount = 0;
        foreach ($transactions as $transaction) {
            $totalTransactionsWithMonth[$transaction->month] = $transaction->sum;
            $totalAmount += $transaction->sum;
        }

        return response()->json([$totalTransactionsWithMonth, $totalAmount]);
    }

    public function showDealWon(Request $request)
    {
        $yearValue = $request->input('yearValue') ?? date('Y');

        $dealsWonSum = Deal::query()
        ->whereYear('created_at', $yearValue)
        ->where('deal_stage_id', 4)
        ->selectRaw('month(created_at) as month')
        ->selectRaw('Sum(estimated_deal) as sum')
        ->groupBy('month')
        ->orderBy('month')
        ->get();


        $totalDealsWonWithMonth = [];
        foreach ($dealsWonSum as $deal) {
            $totalDealsWonWithMonth[$deal->month] = $deal->sum;
        }

        return response()->json($totalDealsWonWithMonth);

    }

    public function showAllDeals(Request $request)
    {
        $yearValue = $request->input('yearValue') ?? date('Y');

        $diffDeals = Deal::query()
        ->selectRaw('MONTH(created_at) as month, COUNT(deal_stage_id) as count')
        ->selectRaw('deal_stage_id')
        ->whereYear('created_at', $yearValue)
        ->groupBy(['month', 'deal_stage_id'])
        ->orderBy('month')
        ->get();

        $dealsNew = [];
        $dealsProposal = [];
        $dealsNegotiation = [];
        $dealsWon = [];
        $dealsLost = [];

        foreach($diffDeals as $diffDeal){
            if($diffDeal->deal_stage_id == 1){
                $dealsNew[$diffDeal->month] = $diffDeal->count;
            }elseif($diffDeal->deal_stage_id == 2){
                $dealsProposal[$diffDeal->month] = $diffDeal->count;
            }elseif($diffDeal->deal_stage_id == 3){
                $dealsNegotiation[$diffDeal->month] = $diffDeal->count;
            }elseif($diffDeal->deal_stage_id == 4){
                $dealsWon[$diffDeal->month] = $diffDeal->count;
            }elseif($diffDeal->deal_stage_id == 5){
                $dealsLost[$diffDeal->month] = $diffDeal->count;
            }
        }

        return response()->json([$dealsNew, $dealsProposal, $dealsNegotiation, $dealsWon, $dealsLost]);

    }

    public function showClients(Request $request)
    {
        $yearValue = $request->input('yearValue') ?? date('Y');

        $clients = Client::query()
            ->whereYear('created_at', $yearValue)
            ->selectRaw('month(created_at) as month')
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    
        $totalClientsWithMonth = [];
        $totalClients = 0;
        foreach ($clients as $client) {
            $totalClientsWithMonth[$client->month] = $client->count;
            $totalClients += $client->count;
        }

        return response()->json([$totalClientsWithMonth, $totalClients]);
    }
}
