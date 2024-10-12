<!DOCTYPE html>
<html>

<head>
    <title>Search Vaccination Status</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .error-messages {
            color: red;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .error-messages ul {
            list-style-type: none;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Search Your Vaccination Status</h1>

        <form method="POST" action="/search">
            @csrf
            <label for="nid">Enter your NID:</label>
            <input type="text" id="nid" name="nid" required>
            <button type="submit">Check Status</button>
        </form>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>

</html>
