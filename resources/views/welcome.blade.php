<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Invoice App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            h1 {
                font-size: 3rem; /* Increase the size of the title */
                text-align: center;
                margin-top: 2rem;
                color: #333;
            }
            .buttons {
                display: flex;
                justify-content: center; /* Center horizontally */
                margin-top: 20px;
            }
            a {
                font-size: 1.5rem; /* Increase the size of Login and Register */
                padding: 10px 20px;
                background-color: #3490dc;
                color: white;
                border-radius: 5px;
                text-decoration: none;
                margin: 0 10px;
            }
            a:hover {
                background-color: #2779bd;
            }
        </style>
    </head>
    <body>
        <div class="relative flex items-center justify-center flex-col min-h-screen bg-gray-100 dark:bg-gray-900 sm:pt-0">

            <!-- Title -->
            <h1>Invoice App</h1>

            @if (Route::has('login'))
                <div class="buttons">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>
