<?php

namespace App\Http\Controllers;

use App\Models\Cashback;
use App\Models\Client;
use App\Models\Shipment;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem; // Certifique-se de ter importado o modelo de OrderItem
use Illuminate\Support\Facades\Log;
use Response;

class OrderController extends Controller
{
    public function index()
    {
        // Supondo que os pedidos têm um relacionamento com `shipments`
        $orders = Order::with('shipment')->all();
        dd($orders);
        // Passando os dados para a view do Inertia
        return Inertia::render('Orders/Index', [
            'orders' => $orders,
        ]);
    }
    public function dashboard()
    {
        // Carregar os 10 itens mais recentes de cada entidade
        $orders = Order::with('shipment')->latest()->take(10)->get();  // Últimas 10 ordens
        $clients = Client::latest()->take(10)->get();  // Últimos 10 clientes
        $cashbacks = Cashback::latest()->take(10)->get();  // Últimos 10 cashbacks
        $shipments = Shipment::latest()->take(10)->get();  // Últimos 10 envios

        // Totais
        $totalOrders = Order::count();
        $totalClients = Client::count();
        $totalCashbacks = Cashback::count();
        $totalShipments = Shipment::count();
        // dd($orders);
        // Passar os dados para o dashboard via Inertia
        return Inertia::render('Dashboard', [
            'orders' => $orders,
            'clients' => $clients,
            'cashbacks' => $cashbacks,
            'shipments' => $shipments,
            'totalOrders' => $totalOrders,
            'totalClients' => $totalClients,
            'totalCashbacks' => $totalCashbacks,
            'totalShipments' => $totalShipments,
        ]);
    }

    public function checkShipment($order_id)
    {
        // Buscar a ordem pelo ID da ordem externa
        $fullorder = Order::where('order_id', $order_id)->first();

        if (!$fullorder) {
            return redirect()->back()->withErrors(['order' => 'Order not found']);
        }

        // Carregar a ordem e verificar se tem shipment
        $order = Order::with('shipment')->find($fullorder->id);

        if ($order && $order->shipment) {
            // Redireciona para a página de status da ordem
            return redirect()->route('order.status', ['order_id' => $order_id]);
        }

        // Se o shipment não existir, retornar com uma mensagem de erro
        return redirect()->back()->withErrors(['shipment' => 'No shipment data available for this order.']);
    }

    public function status($order_id)
    {
        $fullorder = Order::where('order_id', $order_id)->first();

        if (!$fullorder) {
            abort(404, 'Order not found');
        }

        // Buscar a ordem e o shipment
        $order = Order::with('shipment')->findOrFail($fullorder->id);

        // Retornar para a view com os dados da ordem e shipment
        return Inertia::render('Orders/TrackOrderResult', [
            'order' => $order,
            'shipment' => $order->shipment,
        ]);
    }

    public function show($id)
    {
        $order = Order::with(['items', 'shipment'])->findOrFail($id); // Carrega os itens e o envio relacionado com a ordem

        return inertia('Orders/Show', [
            'order' => $order, // Passa a ordem para o componente Vue, incluindo os itens e o envio
            'shipment' => $order->shipment, // Passa o envio
        ]);
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Webhook iniciado.');
        $secret = 'PHo~N9<}_v(kt,SI*|G_5blOy?A*m'; // Chave secreta

        $body = file_get_contents('php://input'); // Corpo da requisição

        if ($body === false || empty($body)) {
            Log::error('Falha ao obter o corpo da solicitação.');
            return response()->json(['error' => 'Corpo da solicitação vazio'], 400);
        }

        Log::info('Conteúdo do Corpo da Solicitação Bruto:', ['body' => $body]);

        $signature = $request->header('X-WC-Webhook-Signature');

        if ($signature === null) {
            Log::error('Nenhuma assinatura fornecida no cabeçalho.');
            return response()->json(['error' => 'Nenhuma assinatura fornecida'], 403);
        }

        Log::info('Assinatura Recebida:', ['signature' => $signature]);

        $expected_signature = base64_encode(hash_hmac('sha256', $body, $secret, true));

        Log::info('Assinatura Esperada:', ['expected_signature' => $expected_signature]);

        if (!hash_equals($expected_signature, $signature)) {
            Log::error('Assinatura do Webhook Inválida', [
                'received_signature' => $signature,
                'expected_signature' => $expected_signature,
            ]);
            return response()->json(['error' => 'Webhook inválido'], 403);
        }

        Log::info('Assinatura válida. Processando o webhook.');

        $orderData = json_decode($body, true);

        if (isset($orderData['id'], $orderData['billing']['first_name'], $orderData['billing']['last_name'], $orderData['billing']['email'], $orderData['line_items'])) {
            try {
                // Cria ou atualiza o cliente apenas com nome e e-mail
                $client = Client::updateOrCreate(
                    ['email' => $orderData['billing']['email']], // Usa o e-mail como chave para atualizar ou criar o cliente
                    [
                        'name' => $orderData['billing']['first_name'] . ' ' . $orderData['billing']['last_name'], // Concatena nome e sobrenome
                        'email' => $orderData['billing']['email'],
                    ]
                );

                // Cria ou atualiza a ordem
                $order = Order::updateOrCreate(
                    ['order_id' => $orderData['id']],
                    [
                        'customer_name' => $orderData['billing']['first_name'] . ' ' . $orderData['billing']['last_name'],
                        'total' => $orderData['total'] ?? 0,
                        'status' => $orderData['status'],
                        'billing_address_1' => $orderData['billing']['address_1'] ?? null,
                        'billing_address_2' => $orderData['billing']['address_2'] ?? null,
                        'billing_city' => $orderData['billing']['city'] ?? null,
                        'billing_state' => $orderData['billing']['state'] ?? null,
                        'billing_postcode' => $orderData['billing']['postcode'] ?? null,
                        'billing_country' => $orderData['billing']['country'] ?? null,
                        'billing_email' => $orderData['billing']['email'] ?? null,
                        'billing_phone' => $orderData['billing']['phone'] ?? null,
                        'payment_method' => $orderData['payment_method'] ?? null,
                        'payment_method_title' => $orderData['payment_method_title'] ?? null,
                        'date_created' => $orderData['date_created'] ?? null,
                        'date_modified' => $orderData['date_modified'] ?? null,
                        'date_completed' => $orderData['date_completed'] ?? null,
                        'date_paid' => $orderData['date_paid'] ?? null,
                        'client_id' => $client->id, // Associa a ordem ao cliente criado/atualizado
                    ]
                );

                // Dispara o job para envio de email de notificação
                dispatch(new \App\Jobs\SendOrderPreparationEmail($order));

                // Processa os itens do pedido
                foreach ($orderData['line_items'] as $itemData) {
                    OrderItem::updateOrCreate(
                        ['order_id' => $order->id, 'product_name' => $itemData['name']],
                        [
                            'quantity' => $itemData['quantity'],
                            'total' => $itemData['total'],
                            'price' => $itemData['price'],
                            'image_url' => $itemData['image']['src'] ?? null,
                        ]
                    );
                }

                Log::info('Ordem e cliente processados com sucesso', ['order_id' => $order->order_id, 'client_id' => $client->id]);
                return response()->json(['message' => 'Ordem e cliente processados com sucesso!']);
            } catch (\Exception $e) {
                Log::error('Falha ao Processar Ordem', [
                    'error' => $e->getMessage(),
                    'orderData' => $orderData,
                ]);
                return response()->json(['error' => 'Falha ao processar a ordem'], 500);
            }
        } else {
            Log::error('Dados Incompletos da Ordem', ['orderData' => $orderData]);
            return response()->json(['error' => 'Dados da ordem incompletos'], 400);
        }
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();  // Isso marcará a ordem como excluída, mas não a removerá fisicamente
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

    public function restore($id)
    {
        $order = Order::withTrashed()->findOrFail($id);  // Isso buscará uma ordem excluída
        $order->restore();  // Isso restaurará a ordem excluída
        return redirect()->back()->with('success', 'Order restored successfully.');
    }

    public function trashed()
    {        
        $trashedOrders = Order::onlyTrashed()->get();  // Busca apenas as ordens excluídas
        // dd($trashedOrders);
        return Inertia::render('Orders/Trashed', [
            'orders' => $trashedOrders,
        ]);
    }


}
