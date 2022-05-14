<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                @if(auth()->user()->type == 'passenger')
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($drivers as $driver)
                        <li>
                            <a href="/taxi/call/{{ $driver->id }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $driver->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(auth()->user()->type == 'driver')
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach($passengers as $passenger)
                        <li>
                            <a href="/taxi/arrived/{{ $passenger->id }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $passenger->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>