<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activity = Activity::filter(request(['search']));

        $direction = 'asc';
        $column = $request->get('column');  
        $direction = $request->get('direction') === 'asc' ? 'desc' : 'asc';

        if($column != ""){
            $activity = $activity->orderBy($column, $direction);
        }

        $activity = $activity->paginate(Config('app.limit'));

        return view('activity.index', [
            'activities' => $activity,
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
        return view('activity.create', [
            'activity' => new Activity(),
            'clients' => Client::select('id', 'client_name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'activity_type' => 'required|max:255',
            'activity_description' => 'required|max:255',
            'created_by_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            session()->flash('success', 'Activity record has been created!');

            $activity = new Activity();
            $activity->client_id = $request->input('client_id');
            $activity->activity_type = $request->input('activity_type');
            $activity->activity_description = $request->input('activity_description');
            $activity->created_by_id = $request->input('created_by_id');
            $activity->save();
            return response()->json([
                'status' => 200
            ]);

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('activity.show', [
            'activity' => Activity::findOrFail($id)
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
        return view('activity.edit', [
            'activity' => Activity::findOrFail($id),
            'clients' => Client::select('id', 'client_name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'activity_type' => 'required|max:255',
            'activity_description' => 'required|max:255',
            'created_by_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            session()->flash('success', 'Activity record has been updated!');

            $activity = Activity::findOrFail($id);
            $activity->client_id = $request->input('client_id');
            $activity->activity_type = $request->input('activity_type');
            $activity->activity_description = $request->input('activity_description');
            $activity->created_by_id = $request->input('created_by_id');
            $activity->update();
            return response()->json([
                'status' => 200,
            ]);

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
        Activity::findOrFail($request->id)->delete();

        session()->flash('success', 'Activity record has been deleted!');

        return redirect(route('activity.index'));
    }
}
