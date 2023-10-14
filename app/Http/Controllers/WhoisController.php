<?php

namespace App\Http\Controllers;

use App\Models\Whois;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class WhoisController extends Controller
{
    public function getWhois($domain)
    {

        \Larva\Whois\Whois::lookup($domain);

        $whois = Whois::where('name', $domain)->first();

        return view('whois.index',[
            'domain' => $whois
        ]);

    }
}
