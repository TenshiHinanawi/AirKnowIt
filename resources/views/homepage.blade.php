<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirKnowIt - Login & Sign Up</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #90caf9, #ffffff);
            color: #333;
        }

        header {
            background-color: #0288d1;
            color: #fff;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5em;
        }

        header p {
            margin: 5px 0 0;
            font-size: 1em;
            font-weight: 300;
        }

        /* Container styles */
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .container h2 {
            font-size: 1.8em;
            margin-bottom: 20px;
            color: #0288d1;
        }

        /* Authentication buttons */
        .auth-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .auth-buttons a {
            padding: 12px 25px;
            background-color: #0277bd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 1em;
            transition: background-color 0.3s ease, transform 0.2s;
            text-align: center;
            flex: 1;
            max-width: 45%;
            min-width: 120px;
        }

        .auth-buttons a:hover {
            background-color: #01579b;
            transform: scale(1.05);
        }

        .auth-buttons a:focus {
            outline: 3px solid #81d4fa;
            background-color: #0277bd;
        }

        .auth-buttons a:active {
            background-color: #01386e;
            transform: scale(0.95);
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            header h1 {
                font-size: 2em;
            }

            .auth-buttons {
                gap: 15px;
            }

            .auth-buttons a {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to AirKnowIt!</h1>
        <p>Enhancing Environmental Awareness Through Real-Time Monitoring</p>
    </header>

    <div class="container">
        <h2>Get Started</h2>
        <div class="auth-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Go to Home</a>
                @else
                    <a href="{{ route('login') }}">Log In</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Sign Up</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>

</html>
