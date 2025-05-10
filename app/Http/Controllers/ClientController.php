<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClientController extends Controller
{
    use AuthorizesRequests;
    public function index()
{
    $clients = Client::all();
    return view('clients.index', ['clients' => $clients]);
}

public function create()
{
    $this->authorize('create', Client::class);
    return view('clients.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'country'=>'required',
        'email' => 'required|email|unique:clients',
        'companies' => 'required|array',
        // alte reguli de validare
    ]);
    
    $client = Client::create($request->only(['name', 'country', 'email']));
    
    // Atașează companiile din formular (venite ca array)
    $client->companies()->sync($request->input('companies'));

    return redirect()->route('clients_index')
        ->with('success', 'Clientul a fost creat cu succes!');
}

public function edit(Client $client)
{
    $this->authorize('edit', $client);

    return view('clients.edit', compact('client'));
}

public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'country'=>'required',
            'companies' => 'required|array',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            // alte reguli de validare
            
        ]);
        $client->update($request->only(['name', 'country', 'email']));

        // Actualizează relația many-to-many
        $client->companies()->sync($request->input('companies'));
        return redirect()->route('clients_index')
            ->with('success', 'Clientul a fost actualizat cu succes!');
    }

public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();
        return redirect()->route('clients_index')
            ->with('success', 'Clientul a fost șters cu succes!');
    }
}
