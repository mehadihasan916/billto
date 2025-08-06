<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Subscription Expired</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 480px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            padding: 32px 24px;
        }
        .header {
            text-align: center;
            color: #e63946;
        }
        .icon {
            font-size: 48px;
            color: #e63946;
            margin-bottom: 12px;
        }
        .details {
            margin: 24px 0;
            font-size: 16px;
            color: #333;
        }
        .btn {
            display: inline-block;
            background: #457b9d;
            color: #fff;
            padding: 12px 32px;
            border-radius: 24px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 18px;
        }
        .footer {
            margin-top: 32px;
            text-align: center;
            color: #888;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="icon">&#9888;</div>
            <h2>Subscription Expired</h2>
        </div>
        <div class="details">
            Hello <strong>{{ $user->name }}</strong>,<br><br>
            Your subscription ended on <strong>{{ \Carbon\Carbon::parse($user->subscription->end_date)->format('F j, Y') }}</strong>.<br>
            To continue enjoying our services, please renew your subscription.
        </div>
        <div style="text-align:center;">
            <a href="{{ url('payment-gateway', $user->subscription->id) }}" class="btn">Renew Now</a>
        </div>
        <div class="footer">
            If you have any questions, please contact our support team.<br>
            &copy; {{ date('Y') }} Billto App
        </div>
    </div>
</body>
</html>
