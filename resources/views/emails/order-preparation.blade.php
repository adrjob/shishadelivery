<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Being Prepared</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333333;
        }
        .details {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dear {{ $order->customer_name }},</h1>
        <p>Thank you for your order!</p>
        <p>We are excited to inform you that your product(s) are currently being prepared for shipment.</p>

        <div class="details">
            <h3>Order Details:</h3>
            <p><strong>Order ID:</strong> {{ $order->order_id }}</p>
            <p><strong>Total Amount:</strong> ${{ $order->total }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->billing_address_1 }}, {{ $order->billing_city }}, {{ $order->billing_state }} - {{ $order->billing_postcode }}</p>
        </div>

        <p>You will receive another email with tracking information once your order has been shipped.</p>
        
        <p>Thank you for shopping with us!</p>
        
        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:support@yourcompany.com">contact us</a>.</p>
            <p>Best regards,<br>The Your Company Team</p>
        </div>
    </div>
</body>
</html>
