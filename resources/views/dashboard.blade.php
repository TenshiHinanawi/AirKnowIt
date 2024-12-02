<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200">
                <a href="{{ url('/') }}"
                    class="text-base font-large text-gray-800 dark:text-gray-200 hover:underline">
                    AirKnowIt
                </a>
            </h2>
            <div class="flex gap-4">
                <a href="{{ url('/historical-weather') }}"
                    class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Historical Weather Data
                </a>
                <a href="{{ url('/historical-air') }}"
                    class="text-base font-medium text-gray-800 dark:text-gray-200 hover:underline">
                    Historical Air Data
                </a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button>
                            <div class="font-bold">{{ Auth::user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="text-gray-800 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-gray-800 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>


            </div>
        </div>
    </x-slot>



            @include('main')

</x-app-layout>
