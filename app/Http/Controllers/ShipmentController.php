<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ShipmentController extends Controller
{
    public function index()
    {
        // Busca todos os envios (shipments) do banco de dados
        $shipments = Shipment::with('order')->get(); // Carrega os relacionamentos com as ordens

        // Retorna a view para o componente Vue 'Shipments/Index' passando os envios
        return Inertia::render('Shipment/Index', [
            'shipments' => $shipments,
        ]);
    }
    /**
     * Exibe o formulário para criar um envio.
     */
    public function create(Order $order)
    {
        return Inertia::render('Shipments/Create', [
            'order' => $order, // Passando o pedido para o componente Vue
        ]);
    }

    /**
     * Armazena um novo envio.
     */
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'tracking_number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'shipping_date' => 'nullable|date',
            'delivery_estimate' => 'nullable|date',
            'shipping_status' => 'required|string|max:255',
        ]);

        // Cria o envio relacionado ao pedido
        Shipment::create([
            'order_id' => $order->id,
            'tracking_number' => $request->tracking_number,
            'carrier' => $request->carrier,
            'shipping_date' => $request->shipping_date,
            'delivery_estimate' => $request->delivery_estimate,
            'shipping_status' => $request->shipping_status,
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Shipment created successfully.');
    }

    public function edit($id)
    {
        $shipment = Shipment::findOrFail($id); // Busca o envio pelo ID

        return Inertia::render('Shipments/UpdateStatus', [
            'shipment' => $shipment, // Passando o shipment para o componente Vue
        ]);
    }

    /**
     * Atualiza o status do envio.
     */
    public function updateStatus(Request $request, Shipment $shipment)
    {
        $request->validate([
            'shipping_status' => 'required|string|max:255',
        ]);

        // Atualiza o status do envio
        $shipment->update([
            'shipping_status' => $request->shipping_status,
        ]);

        return redirect()->route('orders.show', $shipment->order->id)
            ->with('success', 'Shipment status updated successfully.');
    }
}
