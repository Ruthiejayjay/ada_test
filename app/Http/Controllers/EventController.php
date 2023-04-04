<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use Exception;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        try {
            $event = new Event($request->validated());
            $event->user_id = auth()->id();
            $event->save();
            $data = ['data' => $event, 'message' => 'Event Created Successfully', 'success' => true];
            return response()->json($data, 201);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Event Not Created', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return Event::find($event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, $id)
    {
        try{
            $event = Event::find($id);
            $event->update($request->all());
            $data = ['data' => $event, 'message' => 'Event Updated Successfully', 'success' => true];
            return response()->json($data, 200);
        }catch(Exception $e){
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Event Not Updated', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Event::destroy($id);
    }
}
