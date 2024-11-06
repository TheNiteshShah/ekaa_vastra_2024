<!DOCTYPE html>
<html>

<head>
    <title>Order Cancellation Notice</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

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
            font-size: 26px;
            margin-top: 10px;
        }

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
            <h2>Your Order Has Been Cancelled</h2>
        </div>

        <!-- Greeting and Order Info -->
        <div class="order-details">
            <p>Hi {{ $orderData->address->first_name }},</p>
            <p>We're sorry to inform you that your order with us has been cancelled.</p>

            <h3>Order Details:</h3>
            <p><strong>Order ID:</strong> {{ $orderData->id }}</p>
            <p><strong>Order Date:</strong> {{ $orderData->created_at->format('F j, Y, g:i a') }}</p>

            <p>If you have any questions, please feel free to <a href="mailto:info@ekaavastra.com">contact us</a>.</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for shopping with us! We hope to serve you again soon. 😊</p>
            <p><strong>Team Ekaa Vastra 👨‍💻</strong></p>
        </div>
    </div>
</body>

</html>
