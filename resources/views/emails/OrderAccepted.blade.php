<!DOCTYPE html>
<html>

<head>
    <title>Your Order is Accepted!</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container Styles */
        .container {
            width: 90%;
            max-width: 700px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .header img {
            max-width: 120px;
            height: auto;
        }

        .header h1 {
            color: #292929;
            font-size: 28px;
            margin-top: 10px;
        }

        /* Order Details Section */
        .order-details {
            margin-top: 20px;
            padding: 0 10px;
            line-height: 1.6;
        }

        .order-details h3 {
            font-size: 20px;
            color: #292929;
            margin-bottom: 15px;
        }

        .order-details p {
            margin: 5px 0;
        }

        /* Order Summary Table */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        .summary-table th,
        .summary-table td {
            padding: 12px;
            border: 1px solid #e5e5e5;
            text-align: left;
            vertical-align: middle;
        }

        .summary-table th {
            background-color: #333;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        .summary-table td img {
            width: 50px;
            height: auto;
            border-radius: 5px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .product-name {
            display: inline-block;
            vertical-align: middle;
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .summary-table .text-right {
            text-align: right;
        }

        /* Footer Section */
        /* Footer Section */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer a {
            color: #292929;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header with Logo and Heading -->
        <div class="header">
            <img src="https://www.ekaavastra.com/frontend/img/logo.png" alt="Logo">
            <h2>Your Order is Accepted! 🚀</h2>
        </div>

        <!-- Greeting and Order Info -->
        <div class="order-details">
            <p>Hi {{ $orderData->address->first_name }},</p>
            <p>We’re pleased to inform you that your order has been accepted and is being prepared for dispatch!</p>

            <h3>Order Details:</h3>
            <p><strong>Order ID:</strong> {{ $orderData->id }}</p>
            <p><strong>Order Date:</strong> {{ $orderData->created_at->format('F j, Y, g:i a') }}</p>
            <p><strong>Mode of Payment:</strong> {{ $orderData->payment_mode == 1 ? "COD" : "Online"}}</p>
        </div>

        <!-- Order Summary Table -->
        <table class="summary-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orderData->details as $item)
                <tr>
                    <td>
                    <img src="{{asset($item->image)}}" alt="{{ $item->product->name }}">
                        <span class="product-name">{{ $item->product->name }} ({{ $item->type->size->name }})</span>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                </tr>
            @endforeach
                <!-- Subtotal, Discount, Shipping, Total Rows -->
                <tr>
                    <td colspan="2" class="text-right"><strong>Subtotal:</strong></td>
                    <td class="text-right">₹{{ number_format($orderData->total_amount, 2) }}</td>
                </tr>
                @if($orderData->promo_discount)
                <tr>
                    <td colspan="2" class="text-right"><strong>Discount ({{$orderData->promo->name}}):</strong></td>
                    <td class="text-right">-₹{{ number_format($orderData->promo_discount, 2) }}</td>
                </tr>
                @endif
                @if($orderData->wallet_discount)
                <tr>
                    <td colspan="2" class="text-right"><strong>Wallet Discount:</strong></td>
                    <td class="text-right">-₹{{ number_format($orderData->wallet_discount, 2) }}</td>
                </tr>
                @endif
                @if($orderData->shipping)
                <tr>
                    <td colspan="2" class="text-right"><strong>Shipping:</strong></td>
                    <td class="text-right">+₹{{ number_format($orderData->shipping, 2) }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="2" class="text-right"><strong>Total:</strong></td>
                    <td class="text-right"><strong>₹{{ number_format($orderData->final_amount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Footer Section -->
        <div class="footer">
            <p>Need help? <a href="mailto:info@ekaavastra.com">Contact Us</a></p>
            <p>Thank you for choosing Ekaa Vastra! We can’t wait for you to enjoy your purchase.</p>
            <p><strong>Team Ekaa Vastra 👨‍💻</strong></p>
        </div>
    </div>
</body>

</html>
