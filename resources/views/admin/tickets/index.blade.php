@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestion Des Tickets</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Table Des Tickets</div>
        <div class="card-body">
            <table id="tickets-table" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Message</th>
                        <th>Priorité</th>
                        <th>État</th>
                        <th>Client</th>
                        <th style="width: 60px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>{{ $ticket->title }}</td>
                        <td>{{ $ticket->message }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>{{ $ticket->stat }}</td>
                        <td>{{ $ticket->user->name }}</td>
                        <td class="d-flex">
                            <div class="px-2">
                                <form action="{{ route('tickets.validate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
                                    <button type="submit" class="btn btn-success">Validate</button>
                                </form>
                            </div>
                            
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
