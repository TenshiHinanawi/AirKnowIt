<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
            </h2>
            <div class="flex gap-4">
                <a href="{{ url('/search') }}"
                   class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Search Cities
                </a>
                <a href="{{ url('/geolocation') }}"
                   class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Geolocation
                </a>
                <a href="{{ url('/historical-weather') }}"
                   class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Historical Weather Data
                </a>
                <a href="{{ url('/historical-air') }}"
                   class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Historical Air Data
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-lg">
                <div class="p-6 text-center text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
