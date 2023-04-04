<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventTicketRequest;
use App\Http\Requests\UpdateEventTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Exception;
use Illuminate\Http\Request;

class EventTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventTicketRequest $request)
    {
    
        try {
            $ticket = new Ticket($request->validated());
            $ticket->event_id = $request->event_id;
            $ticket->save();
            $data = ['data' => $ticket, 'message' => 'Ticket Created Successfully', 'success' => true];
            return response()->json($data, 201);
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Ticket Not Created', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
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
        return Ticket::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventTicketRequest $request, $id)
    {
        try{
            $ticket = Ticket::find($id);
            $ticket->update($request->all());
            $data = ['data' => $ticket, 'message' => 'Ticket Updated Successfully', 'success' => true];
            return response()->json($data, 200);
        }catch(Exception $e){
            $errorMsg = $e->getMessage();
            $data = ['data' => null, 'message' => 'Ticket Not Updated', 'success' => false, 'error' => $errorMsg];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ticket::destroy($id);
        return response()->json(['message'=>'Deleted'], 200);
    }
}
