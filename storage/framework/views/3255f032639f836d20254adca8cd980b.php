<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Swim Event</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #C32A25; /* Project Red */
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .details-table th, .details-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
        .details-table th {
            color: #C32A25;
            font-weight: bold;
            width: 40%;
        }
        .btn-login {
            display: inline-block;
            background-color: #C32A25;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .footer {
            background: #eee;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to Swim Event!</h1>
        </div>
        
        <div class="content">
            <p>Hi <strong><?php echo e($user->name); ?></strong>,</p>
            <p>Thank you for creating an account with Swim Event.</p>
            <p>Your registration is complete, and your account is ready to use.</p>
            
            <table class="details-table">
                <tr>
                    <th>Email</th>
                    <td><?php echo e($user->email); ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo e(ucfirst($user->role)); ?></td>
                </tr>
                <?php if($user->sub_role): ?>
                <tr>
                    <th>Organization Type</th>
                    <td><?php echo e(ucfirst($user->sub_role)); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th>Member Since</th>
                    <td><?php echo e($user->created_at->format('d M Y')); ?></td>
                </tr>
            </table>

            <div style="text-align: center;">
                <a href="<?php echo e(route('login')); ?>" class="btn-login">Login to Dashboard</a>
            </div>
        </div>

        <div class="footer">
            &copy; <?php echo e(date('Y')); ?> Swim Event System. All rights reserved.
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\HP\.gemini\antigravity\scratch\BDT-K1-Swiming-System\resources\views/emails/user_welcome.blade.php ENDPATH**/ ?>