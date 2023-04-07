<?php

namespace App\Http\Controllers;

use App\Enums\TransactionStatusEnum;
use App\Http\Requests\StoreTicketTransactionsRequest;
use App\Models\TicketTransactions;
use Exception;
use Illuminate\Http\Request;

class TicketTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TicketTransactions::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketTransactionsRequest $request)
    {
        $checkout = new TicketTransactions($request->validated());
        $checkout->ticket_id = $request->ticket_id;
        $checkout->first_name = auth()->user()->first_name;
        $checkout->last_name = auth()->user()->last_name;
        $checkout->email = auth()->user()->email;
        try {
            if ($checkout->save()) {
                $checkout->status = TransactionStatusEnum::successful;
                TicketTransactions::where('id', $checkout->id)->update(['status'=>TransactionStatusEnum::successful]);
                $data = ['data' => $checkout, 'message' => 'Successfully', 'success' => true];
                return response()->json($data, 201);
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $checkout->status = TransactionStatusEnum::failed;
            TicketTransactions::where('id', $checkout->id)->update(['status'=>TransactionStatusEnum::failed]);
            $data = ['data' => null, 'message' => 'Failed', 'success' => false, 'error' => $errorMsg];
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
