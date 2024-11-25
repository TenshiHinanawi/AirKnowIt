<x-guest-layout>
    <style>
        body {
            background: linear-gradient(to bottom, #90caf9, #ffffff);
            font-family: Arial, sans-serif;
            color: #333;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #0288d1;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: inset 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        input:focus {
            outline: none;
            border-color: #0288d1;
            box-shadow: 0 0 5px rgba(2, 136, 209, 0.5);
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9em;
        }

        .form-footer {
            margin-top: 20px;
            text-align: center;
        }

        .form-footer a {
            color: #0288d1;
            text-decoration: none;
            font-size: 0.9em;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        button {
            width: 100%;
            background-color: #0277bd;
            color: white;
            border: none;
            padding: 12px;
            font-size: 1em;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #01579b;
        }

        button:focus {
            outline: 3px solid #81d4fa;
            background-color: #0277bd;
        }

        button:active {
            background-color: #01386e;
        }

        @media (max-width: 400px) {
            .login-container {
                margin: 20px;
                padding: 15px;
            }

            h2 {
                font-size: 1.5em;
            }
        }
    </style>

    <div class="login-container">
        <h2>Log In</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="form-group remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">{{ __('Remember me') }}</label>
            </div>

            <!-- Forgot Password -->
            <div class="form-footer">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit">
                {{ __('Log in') }}
            </button>
        </form>
    </div>
</x-guest-layout>
