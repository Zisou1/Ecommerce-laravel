<?php

namespace App\Http\Controllers;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Ticket::all()->load('user');
        if($request->ajax()){
            return response()->json($tickets);
        }
        return view('admin.tickets.index',compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    
    //  public function create()
    // {
        
    //     return view('backend.tickets.create');
        
    // }

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
        return redirect()->route('client.tickets');
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
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect('/admin/tickets');
    }

    public function validate_ticket(Request $request)
{
    $ticket = Ticket::findOrFail($request->ticketId);
    $ticket->stat = 1; // Update the status to 1
    $ticket->save();
    
    return redirect()->back();
}

    // SECTION CLIENT 

    public function clientTickets(){
        $tickets = Ticket::where('user_id',auth()->user()->id)->get()->load('user');
        return view('user.tickets.index',compact('tickets'));
    }
}

