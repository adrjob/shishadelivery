<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    // Método para listar todos os clientes
    public function index()
    {
        // Recupera todos os clientes do banco de dados
        $clients = Client::all();

        // Retorna a página com a lista de clientes usando Inertia
        return Inertia::render('Clients/Index', [
            'clients' => $clients,
        ]);
    }

    // Método para exibir um cliente específico
    public function show($id)
    {
        // Busca o cliente pelo ID
        $client = Client::findOrFail($id);

        // Retorna a página com os detalhes do cliente
        return Inertia::render('Clients/Show', [
            'client' => $client,
        ]);
    }

    // Método para exibir o formulário de edição de cliente
    // public function edit($id)
    // {
    //     // Busca o cliente pelo ID
    //     $client = Client::findOrFail($id);

    //     // Retorna a página de edição do cliente
    //     return Inertia::render('Clients/Edit', [
    //         'client' => $client,
    //     ]);
    // }

    // Método para atualizar um cliente
    public function update(Request $request, $id)
    {
        // Valida os dados do cliente
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
        ]);

        // Busca o cliente e atualiza os dados
        $client = Client::findOrFail($id);
        $client->update($request->all());

        // Redireciona de volta para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    // Método para excluir um cliente
    public function destroy($id)
    {
        // Busca o cliente e o deleta
        $client = Client::findOrFail($id);
        $client->delete();

        // Redireciona de volta para a lista de clientes com uma mensagem de sucesso
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }
}
