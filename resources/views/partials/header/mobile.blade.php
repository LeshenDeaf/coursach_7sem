<div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right z-10 md:hidden hidden"
     id="mobile_menu"
>
    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
        <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
                <div class="h-8 w-auto">
                    <a class="font-bold" href="{{ url('/') }}">
                        {{ config('app.name', 'ZKH') }}
                    </a>
                </div>
                <div class="-mr-2">
                    <button type="button"
                            class="toggle_mobile bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500"
                    >
                        <span class="sr-only">Close menu</span>
                        <!-- Heroicon name: outline/x -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <nav class="mt-6">
                <div class="grid gap-y-8">
                    <div class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50">
                        @if(auth()->check() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.users.index') }}"
                               class="text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                               aria-expanded="false">
                                {{ __('List of users') }}
                            </a>
                        @endif
                    </div>
                    @guest
                        <div>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700"
                                >
                                    {{ __('Register') }}
                                </a>
                            @endif

                            @if (Route::has('login'))
                                <p class="mt-6 text-center text-base font-medium text-gray-500">
                                    Existing customer?
                                    <a href="{{ route('login') }}"  class="text-blue-600 hover:text-blue-500">
                                        {{ __('Login') }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    @else
                        <div class="relative">
                            <div class="text-gray-500 bg-white rounded-md inline-flex items-center text-base font-medium"
                                    aria-expanded="false"
                                    id="toggle_menu"
                            >
                                {{ Auth::user()->name }}
                            </div>

                            <div class="py-6 px-5 space-y-6">
                                <div class="grid grid-cols-2 gap-y-4 gap-x-8">
                                    <a class="text-base font-medium text-gray-900 hover:text-gray-700"
                                       href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="text-base font-medium text-gray-900 hover:text-gray-700"
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
                    @endguest
                </div>
            </nav>
        </div>
    </div>
</div>
