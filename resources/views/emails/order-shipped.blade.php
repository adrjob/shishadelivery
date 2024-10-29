<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Shipped</title>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $order->customer_name }},</h1>
        <p>Your order has been shipped and is on its way!</p>
        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p><strong>Total Amount:</strong> ${{ $order->total }}</p>
        <p>Thank you for shopping with us!</p>
    </div>
</body>
</html>
