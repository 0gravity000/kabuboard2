<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        銘柄一覧
                    </x-nav-link>
                    <x-nav-link :href="route('dailyprice')" :active="request()->routeIs('dailyprice')">
                        株価
                    </x-nav-link>
                    <x-nav-link :href="route('dailyvolume')" :active="request()->routeIs('dailyvolume')">
                        出来高
                    </x-nav-link>
                    <x-nav-link :href="route('signalakasan')" :active="request()->routeIs('signalakasan')">
                        赤三兵
                    </x-nav-link>
                    <x-nav-link :href="route('signalkurosan')" :active="request()->routeIs('signalkurosan')">
                        黒三兵
                    </x-nav-link>
                </div>
            </div>

            <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
        
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                    @endauth
                </div>
                @endif
            </div>

        </div>
    </div>

</nav>
