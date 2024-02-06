<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketControllerSeller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ticket::create([
            'title' => $request->title,
            'priority' => $request->gravity,
            'message' => $request->message,
            'user_id'=>auth()->user()->id,
            'date_ouverture' => Carbon::now()
        ]);
        return redirect()->route('seller.tickets');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function clientTickets(){
        $tickets = Ticket::where('user_id',auth()->user()->id)->get()->load('user');
        return view('seller.tickets.index',compact('tickets'));
    }
}
