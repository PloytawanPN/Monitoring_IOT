{{-- <!DOCTYPE html>
<html>
<head>
    <title>Token</title>
</head>
<body>
    <a href="http://127.0.0.1:8000/VerifieldEmail/{{ $token }}">Verify Email</a>
</body>
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        *{
            overflow: hidden !important;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .container {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .email-content {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 600px;
            width: 100%;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333333;
        }
        .body {
            margin-bottom: 20px;
            text-align: center;
        }
        .body p {
            color: #666666;
            line-height: 1.5;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            margin: auto
        }
        .button a{
            color: #ffffff;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-content">
            <div class="header">
                <h1>Email Verification</h1>
            </div>
            <div class="body">
                <p>Hi there,</p>
                <p>Thank you for registering with our service. Please verify your email address by clicking the link below:</p>
                <a style="color: white" href="{{ url('/VerifieldEmail/' . $token) }}" class="button">Verify Email</a>
            </div>
        </div>
    </div>
</body>
</html>
