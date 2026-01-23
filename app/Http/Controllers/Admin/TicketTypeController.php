<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketTypes = TicketType::all();
        return view('admin.ticket_type.index', compact('ticketTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $events = Event::orderBy('judul')->get();
        return view('admin.ticket_type.create', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name'     => 'required|string|max:100',
            'price'    => 'required|numeric|min:0',
            'quota'    => 'required|integer|min:1',
        ]);

        TicketType::create($request->all());

        return redirect()->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(TicketType $ticketType)
    {
        return view('admin.ticket_type.show', compact('ticketType'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketType $ticketType)
    {
        $events = Event::orderBy('judul')->get();

        return view('admin.ticket_type.edit', compact('ticketType', 'events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TicketType $ticketType)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name'     => 'required|string|max:255',
            'price'    => 'required|numeric|min:0',
            'quota'    => 'required|integer|min:1',
        ]);

        $ticketType->update([
            'event_id' => $request->event_id,
            'name'     => $request->name,
            'price'    => $request->price,
            'quota'    => $request->quota,
        ]);

        return redirect()->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketType $ticketType)
    {
        $ticketType->delete();

        return redirect()->route('admin.ticket-types.index')
            ->with('success', 'Tipe tiket berhasil dihapus');
    }
}
