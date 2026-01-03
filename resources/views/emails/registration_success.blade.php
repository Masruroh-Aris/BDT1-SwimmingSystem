<!DOCTYPE html>
<html>
<head>
    <title>Registration Confirmation</title>
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
        .footer {
            background: #eee;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
            background-color: #ffc107; /* Warning for Pending */
        }
        .paid { background-color: #198754; }
        .pending { background-color: #ffc107; color: #000; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registration Successful</h1>
        </div>
        
        <div class="content">
            <p>Hello,</p>
            <p>A new registration has been successfully input into the Swim Event system.</p>
            
            <table class="details-table">
                <tr>
                    <th>Registration ID</th>
                    <td>#{{ $registration->id }}</td>
                </tr>
                <tr>
                    <th>Athlete Name</th>
                    <td>{{ $registration->athlete_name }}</td>
                </tr>
                <tr>
                    <th>Meet Program</th>
                    <td>{{ $registration->meet_name }}</td>
                </tr>
                <tr>
                    <th>Event Category</th>
                    <td>{{ $registration->event_name }}</td>
                </tr>
                <tr>
                    <th>Total Fee</th>
                    <td>Rp {{ number_format($registration->fee, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($registration->status == 'Paid')
                            <span class="status-badge paid">PAID</span>
                        @else
                            <span class="status-badge pending">{{ strtoupper($registration->status) }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Input By</th>
                    <td>{{ $registration->input_by }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $registration->created_at->format('d M Y, H:i') }}</td>
                </tr>
            </table>

            <p style="margin-top: 25px;">
                You can view the details and manage this registration via the <a href="{{ route('admin.dashboard') }}" style="color: #C32A25; text-decoration: none; font-weight: bold;">Admin Dashboard</a>.
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Swim Event System. All rights reserved.
        </div>
    </div>
</body>
</html>
