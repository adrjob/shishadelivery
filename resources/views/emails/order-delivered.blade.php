<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Delivered</title>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $order->customer_name }},</h1>
        <p>Your order has been successfully delivered!</p>
        <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
        <p><strong>Total Amount:</strong> ${{ $order->total }}</p>
        <p>We hope you enjoy your purchase. Thank you for choosing us!</p>
    </div>
</body>
</html>
