<x-guest-layout>
    <style>
        body {
            background: linear-gradient(to bottom, #4fc3f7, #ffffff); /* Light sky blue gradient */
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .register-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #0288d1;
            font-size: 2em;
            margin-bottom: 20px;
        }

        img.logo {
            width: 60px;
            height: auto;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
            color: #4caf50; /* Fresh green for labels */
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: inset 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 1em;
        }

        input:focus {
            outline: none;
            border-color: #0288d1;
            box-shadow: 0 0 8px rgba(2, 136, 209, 0.5);
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
            background-color: #0288d1;
            color: white;
            border: none;
            padding: 14px;
            font-size: 1.1em;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #01579b;
        }

        button:focus {
            outline: 3px solid #81d4fa;
            background-color: #0288d1;
        }

        button:active {
            background-color: #01579b;
        }

        @media (max-width: 400px) {
            .register-container {
                margin: 20px;
                padding: 15px;
            }

            h2 {
                font-size: 1.7em;
            }
        }
    </style>

    <div class="register-container">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">{{ __('Email') }}</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Already Registered -->
            <div class="form-footer">
                <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            </div>

            <!-- Submit Button -->
            <button type="submit">
                {{ __('Register') }}
            </button>
        </form>
    </div>
</x-guest-layout>
