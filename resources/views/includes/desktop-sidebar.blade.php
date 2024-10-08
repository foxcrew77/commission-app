<!-- Desktop sidebar -->

<aside
        class="z-20 w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
>
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a
                class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
                href="{{ route('admin.home')}}"
        >
            Commission App
        

        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.home'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                @endif
        
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.home')}}"
                >
                    <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                    >
                        <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                        ></path>
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.deliverytrip.index'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                    @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/deliverytrip*') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.deliverytrip.index') }}"
                >
                    <svg
                            class="w-5 h-5"
                            aria-hidden="true"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                    >
                        <path
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"
                        ></path>
                    </svg>
                    <span class="ml-4">Delivery Trip</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.lorry.index'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/lorry*') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.lorry.index') }}"
                >
                    <i data-feather="truck" class="" style="width:20"></i>
                    <span class="ml-4">Lorry</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.driver.index'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/driver*') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.driver.index') }}"
                >
                <span class="pr-4 -ml-2 material-symbols-outlined">person</span>
                    <span class="ml-3">Driver</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.workman.index'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/workman*') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.workman.index') }}"
                >
                    
                <span class="-ml-2 material-symbols-outlined">group</span>
                    <span class="ml-3">Workman</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.modals'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/modals') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.modals') }}"
                >
                <i data-feather="calendar" style="width:20"></i>
                    <span class="ml-4">Calendar</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->routeIs('admin.tables'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                    aria-hidden="true"></span>
                @endif
                <a
                        class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                        {{ Request::is('dashboard/tables') ? 'text-gray-800 dark:text-gray-100' : '' }}
                        "
                        href="{{ route('admin.tables') }}"
                >
                <i data-feather="table" style="width:20"></i>
                    <span class="ml-4">Tables</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                <button
                        class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="togglePagesMenu"
                        aria-haspopup="true"
                >
                <span class="inline-flex items-center">
                  <svg
                          class="w-5 h-5"
                          aria-hidden="true"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                  >
                    <path
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                  <span class="ml-4" {{ Request::is('dashboard/pages*') ? 'text-gray-800 dark:text-gray-100' : '' }}>Pages</span>
                </span>
                    <svg
                            class="w-4 h-4"
                            aria-hidden="true"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                    >
                        <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                    <ul
                            x-transition:enter="transition-all ease-in-out duration-300"
                            x-transition:enter-start="opacity-25 max-h-0"
                            x-transition:enter-end="opacity-100 max-h-xl"
                            x-transition:leave="transition-all ease-in-out duration-300"
                            x-transition:leave-start="opacity-100 max-h-xl"
                            x-transition:leave-end="opacity-0 max-h-0"
                            class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                            aria-label="submenu"
                    >
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.page.login') }}">Login</a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.page.create-account') }}">
                                Create account
                            </a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.page.forgot-password') }}">
                                Forgot password
                            </a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.page.404') }}">404</a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.page.blank') }}">Blank</a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.buttons') }}">button</a>
                        </li>
                        <li
                                class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        >
                            <a class="w-full" href="{{ route('admin.modals') }}">modals</a>
                        </li>
                    </ul>
                </template>
            </li>
        </ul>
        <div class="px-6 my-6">
            <a href="{{ route('admin.deliverytrip.create') }}">
                <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                Add New Delivery Trip
                <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </a>
        </div>
    </div>
</aside>