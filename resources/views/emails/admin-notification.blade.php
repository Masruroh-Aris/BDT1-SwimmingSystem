<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background-color: #A93333;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
        }
        .user-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Swim Event System</h1>
        </div>
        <div class="content">
            <h2>New User Registration</h2>
            <p>A new user has registered in the system. Here are the details:</p>
            <div class="user-info">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> {{ $user->role }}</p>
                <p><strong>Sub Role:</strong> {{ $user->sub_role ?? 'N/A' }}</p>
                <p><strong>Registered At:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <p>Please review the registration as needed.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Swim Event System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>