<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVID Vaccine Registration</title>
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

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #555;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input:focus,
        select:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .form-container p {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        a.btn {
            display: block;
            width: 95%;
            padding: 10px;
            background-color: #f1ba20;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        a.btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Vaccine Registration</h2>
        @if (session('error'))
            <div class="alert alert-danger"
                style="color: white; background-color: #ff4c4c; border-radius: 5px; padding: 15px; margin: 10px 0; font-weight: bold;">
                {{ session('error') }}
            </div>
        @endif
        <form action="/register" method="POST">
            @csrf
            <label for="nid">NID:</label>
            <input type="text" id="nid" name="nid" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="vaccine_center_id">Vaccine Center:</label>
            <select id="vaccine_center_id" name="vaccine_center_id" required>
                @foreach ($vaccineCenters as $center)
                    <option value="{{ $center->id }}">{{ $center->name }} (Limit: {{ $center->daily_limit }})</option>
                @endforeach
            </select>

            <button type="submit">Register</button>
        </form>
        <br>
        <a href="/search" class="btn btn-primary">Check Status</a>
        <p>Please fill out all fields to register for the COVID vaccine.</p>
    </div>
</body>
</html>
