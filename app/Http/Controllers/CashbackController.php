<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cashback;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CashbackController extends Controller
{
    // Método para armazenar ou atualizar o cashback
    public function store(Request $request)
    {
        // Validação dos dados recebidos no formulário
        $request->validate([
            'order_id' => 'required|exists:orders,order_id', // Verifica se o order_id existe na tabela orders
            'email' => 'required|email',
            'trx_wallet' => 'required|string',
        ]);

        // Verifica se a ordem com o ID existe e corresponde ao email fornecido
        $order = Order::where('order_id', $request->order_id)
            ->where('billing_email', $request->email) // Verificação de correspondência do email
            ->first();

        // Se a ordem não for encontrada ou o email não corresponder, exibe uma mensagem de erro
        if (!$order) {
            return redirect()->back()->withErrors(['error' => 'Order ID and Email do not match.']);
        }

        // Se a ordem for encontrada e o email corresponder, cria ou atualiza a carteira TRX no cashback
        $cashback = Cashback::updateOrCreate(
            ['order_id' => $order->id],
            [
                'trx_wallet' => $request->trx_wallet,
                'status' => 'pending',
                'coin_amount' => 0,  // Definir um valor padrão para coin_amount
            ]
        );


        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'TRX wallet saved successfully!');
    }

    // Método para exibir todos os cashbacks
    public function index()
    {
        $cashbacks = Cashback::with('order')->get();

        // Retorna a view com a lista de cashbacks
        return Inertia::render('Cashback/Index', [
            'cashbacks' => $cashbacks,
        ]);
    }

    // Método para marcar um cashback como pago
    public function markAsPaid($id)
    {
        $cashback = Cashback::findOrFail($id);
        $cashback->status = 'paid';  // Atualiza o status para 'paid'
        $cashback->save();

        return redirect()->back()->with('success', 'Cashback marked as paid successfully!');
    }
}
