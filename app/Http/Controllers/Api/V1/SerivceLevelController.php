<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceLevelRequest;
use App\Models\ServiceLevel;
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
    public function index()
    {
        return response()->json(ServiceLevel::all());
    }

    public function show($id)
    {
        return response()->json(ServiceLevel::findOrFail($id));
    }
}
