<div class="flex justify-between items-center py-6 md:justify-start md:space-x-10">
    <div class="flex justify-start lg:w-0 lg:flex-1">
        <a class="font-bold" href="{{ url('/') }}">
            {{ config('app.name', 'ZKH') }}
        </a>
    </div>

    <div class="-mr-2 -my-2 md:hidden">
        <button type="button"
                class="toggle_mobile bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                aria-expanded="false"
        >
            <span class="sr-only">Open menu</span>
            <!-- Heroicon name: outline/menu -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <nav class="hidden md:flex space-x-10">
        <div class="relative">
            @auth
                <?php
                if (!function_exists('getTextColor')) {
                    function getTextColor(string $routeName): string
                    {
                        return \Route::currentRouteName() === $routeName
                            ? '700'
                            : '500';
                    }
                }
                ?>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}"
                       class="text-gray-{{ getTextColor('admin.users.index') }} group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       aria-expanded="false">
                        {{ __('List of users') }}
                    </a>
                @endif
                <a href="{{ route('home.forms.index') }}"
                   class="ml-8 text-gray-{{ getTextColor('home.forms.index') }} group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   aria-expanded="false">
                    {{ __('Forms') }}
                </a>

                <a href="{{ route('home.answers.index') }}"
                   class="ml-8 text-gray-{{ getTextColor('home.answers.index') }} group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   aria-expanded="false">
                    {{ __('Results') }}
                </a>

                <a href="{{ route('home.forum.index') }}"
                   class="ml-8 text-gray-{{ getTextColor('home.forum.index') }} group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   aria-expanded="false">
                    {{ __('Forum') }}
                </a>
            @endauth
        </div>
    </nav>

    <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
        @guest
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                    {{ __('Login') }}
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700">
                    {{ __('Register') }}
                </a>
            @endif
        @else
            @include('partials.header.notifications', ['notifications' => $notifications ?? new \Illuminate\Database\Eloquent\Collection()])

            <div class="relative">
                <button class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        aria-expanded="false"
                        id="toggle_menu"
                >
                    <span>{{ Auth::user()->name }}</span>

                    <svg class="text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="absolute z-10 left-1/2 transform -translate-x-1/2 mt-3 px-2 sm:px-0 hidden"
                     id="showable"
                >
                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                        <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8 w-auto">
                            <a class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"
                               href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <a class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"
                               href="{{ route('home.index') }}"
                            >
                                {{ __('Personal page') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
    </div>
</div>
