<!DOCTYPE html>
<html>

<head>
    <title>Your OTP for Login</title>
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

        .otp-details {
            margin-top: 20px;
            padding: 0 10px;
            line-height: 1.6;
        }

        .otp-details h3 {
            font-size: 20px;
            color: #292929;
            margin-bottom: 15px;
        }

        .otp-details p {
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
            <h2>Your OTP for Login</h2>
        </div>

        <!-- Greeting and OTP Info -->
        <div class="otp-details">
            <p>Hi,</p>
            <p>Greeting!</p>
            <p>We received a request to log in to your account. Please use the following one-time password (OTP) to complete the login process.</p>

            <h3>OTP Details:</h3>
            <p><strong>Your OTP:</strong> {{ $otp }}</p>

            <p>If you did not request this OTP, please ignore this email.</p>
            <p>If you need further assistance, feel free to <a href="mailto:info@ekaavastra.com">contact us</a>.</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>Thank you for choosing Ekaa Vastra! We hope to serve you again soon. 😊</p>
            <p><strong>Team Ekaa Vastra 👨‍💻</strong></p>
        </div>
    </div>
</body>

</html>
