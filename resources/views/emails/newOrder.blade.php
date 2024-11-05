<!DOCTYPE html>
<html>

<head>
    <title>New Order Received</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .header h1 {
            color: #333;
            font-size: 26px;
            font-weight: 600;
            margin: 0;
        }

        .icon {
            margin-right: 8px;
            color: #292929;
        }

        .order-details,
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        .order-details th,
        .order-details td,
        .summary-table th,
        .summary-table td {
            padding: 12px;
            border: 1px solid #e0e0e0;
            text-align: left;
            /* border-radius: 4px; */
        }

        .order-details th {
            background-color: #fafafa;
            color: #555;
        }

        .summary-table th {
            background-color: #292929;
            color: white;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
        }

        .summary-table td {
            text-align: left;
            color: #333;
        }

        .summary-table td img {
            float: left;
            max-width: 60px;
            height: auto;
            margin-right: 15px;
            border-radius: 5px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header with Centered Logo and Title -->
        <div class="header">
            <img src="https://www.ekaavastra.com/frontend/img/logo.png" alt="Logo">
            <h2>રાધે રાધે 🙏🌺𓃔🦚❤</h2>
            <h1>🛍️ New Order Received!</h1>
        </div>

        <p>👋 Dear Admin,</p>
        <p>A new order has been placed on your website. Here are the details:</p>

        <!-- Order Details Table -->
        <table class="order-details">
            <tr>
                <th>🆔 Order ID</th>
                <td>{{ $orderData->id }}</td>
            </tr>
            <tr>
                <th>💳 Payment Mode</th>
                <td>{{ $orderData->payment_mode == 1 ? "COD" : "Online" }}</td>
            </tr>
            <tr>
                <th>👤 Customer Name</th>
                <td>{{ $orderData->address->first_name }} {{ $orderData->address->last_name }}</td>
            </tr>
            <tr>
                <th>📧 Customer Email</th>
                <td>{{ $orderData->address->email }}</td>
            </tr>
            <tr>
                <th>📞 Customer Phone</th>
                <td>{{ $orderData->address->phone }}</td>
            </tr>
            <tr>
                <th>📍 Customer Address</th>
                <td>{{ $orderData->address->address }} - {{ $orderData->address->pincode }}</td>
            </tr>
            <tr>
                <th>📅 Order Date</th>
                <td>{{ $orderData->created_at->format('F j, Y, g:i a') }}</td>
            </tr>
            <tr>
                <td>💸 SubTotal</td>
                <td class="product_table text-right">₹{{ number_format($orderData->total_amount, 2) }}</td>
            </tr>
            @if($orderData->discount)
            <tr>
                <td>🔖 Discount</td>
                <td class="product_table text-right">-₹{{ number_format($orderData->discount, 2) }}</td>
            </tr>
            @endif
            @if($orderData->wallet_discount)
            <tr>
                <td>💰 Wallet Discount</td>
                <td class="product_table text-right">-₹{{ number_format($orderData->wallet_discount, 2) }}</td>
            </tr>
            @endif
            @if($orderData->shipping)
            <tr>
                <td>🚚 Shipping</td>
                <td class="product_table text-right">+₹{{ number_format($orderData->shipping, 2) }}</td>
            </tr>
            @endif
            <tr>
                <th>💳 Total</th>
                <th class="product_table text-right">₹{{ number_format($orderData->final_amount, 2) }}</th>
            </tr>

        </table>

        <!-- Order Summary Section with Product Images -->
        <h3 style="margin-top: 25px; color: #333; font-size: 20px;">📦 Order Summary</h3>
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
                        {{ $item->product->name }} ({{ $item->type->size->name }})
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ number_format($item->price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>If you need further details, you can access the order through your admin dashboard.</p>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you ❤</p>
            <p>Team Ekaa Vastra 👨‍💻</p>
        </div>
    </div>
</body>

</html>