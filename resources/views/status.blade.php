<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccine Registration Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .status-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .status-container p {
            font-size: 18px;
            padding: 10px;
            border-radius: 5px;
            margin: 15px 0;
            font-weight: bold;
        }

        .status-not-registered {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-scheduled {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-not-scheduled {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-vaccinated {
            background-color: #d4edda;
            color: #155724;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="status-container">
        @if (isset($message))
            <p>{{ $message }}</p>
        @endif

        @if (isset($status) && $status == 'Not registered')
            <p class="status-not-registered">Status: Not registered. <a href="/">Register here</a></p>
        @elseif (isset($status) && $status == 'Scheduled')
            <p class="status-scheduled">Status: Scheduled for {{ $scheduledDate ?? '' }}</p>
        @elseif (isset($status) && $status == 'Not scheduled')
            <p class="status-not-scheduled">Status: Not scheduled yet. Please wait for your schedule.</p>
        @elseif (isset($status) && $status == 'Vaccinated')
            <p class="status-vaccinated">Status: Vaccinated on {{ $scheduledDate ?? '' }}</p>
        @endif
    </div>
</body>

</html>
