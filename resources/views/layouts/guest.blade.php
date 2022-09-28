<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <section class="mb-40">
            <nav class="navbar navbar-expand-lg shadow-md py-2 bg-white relative flex items-center w-full justify-between">
                <div class="container mx-auto px-6 w-full flex flex-wrap items-center justify-between">
                    <div class="flex items-center">
                        <button
                            class="navbar-toggler border-0 py-3 lg:hidden leading-none text-xl bg-transparent text-gray-600 hover:text-gray-700 focus:text-gray-700 transition-shadow duration-150 ease-in-out mr-2"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContentY"
                            aria-controls="navbarSupportedContentY"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                        >
                            <svg
                                aria-hidden="true"
                                focusable="false"
                                data-prefix="fas"
                                class="w-5"
                                role="img"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512"
                            >
                                <path
                                    fill="currentColor"
                                    d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"
                                ></path>
                            </svg>
                        </button>
                        <a class="navbar-brand text-dark-600" href="{{ route('front.store') }}">
                            <svg class="w-5 h-5 ml-2 lg:ml-0 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <path fill="currentColor" d="M485.5 0L576 160H474.9L405.7 0h79.8zm-128 0l69.2 160H149.3L218.5 0h139zm-267 0h79.8l-69.2 160H0L90.5 0zM0 192h100.7l123 251.7c1.5 3.1-2.7 5.9-5 3.3L0 192zm148.2 0h279.6l-137 318.2c-1 2.4-4.5 2.4-5.5 0L148.2 192zm204.1 251.7l123-251.7H576L357.3 446.9c-2.3 2.7-6.5-.1-5-3.2z"></path>
                            </svg>
                        </a>
                    </div>
                    <div class="navbar-collapse collapse grow items-center" id="navbarSupportedContentY">
                        <ul class="navbar-nav mr-auto lg:flex lg:flex-row">
                            <li class="nav-item">
                                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-500 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out" href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-500 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out" href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light">Team</a>
                            </li>
                            <li class="nav-item mb-2 lg:mb-0">
                                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-500 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out" href="#!" data-mdb-ripple="true" data-mdb-ripple-color="light">Projects</a>
                            </li>
                        </ul>
                    </div>
                    @auth
                        <div class="flex items-center relative">

                            <!-- Shopping cart icon -->
                            <a class="text-gray-500 hover:text-gray-700 focus:text-gray-700 mr-4" href="{{ route('cart.index') }}">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        fill="currentColor"
                                        d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"
                                    ></path>
                                </svg>
                            </a>

                            <!-- Notification icon -->
                            <a class="text-gray-500 hover:text-gray-700 focus:text-gray-700 mr-4 dropdown-toggle hidden-arrow flex items-center" href="#">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bell" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="currentColor" d="M224 512c35.32 0 63.97-28.65 63.97-64H160.03c0 35.35 28.65 64 63.97 64zm215.39-149.71c-19.32-20.76-55.47-51.99-55.47-154.29 0-77.7-54.48-139.9-127.94-155.16V32c0-17.67-14.32-32-31.98-32s-31.98 14.33-31.98 32v20.84C118.56 68.1 64.08 130.3 64.08 208c0 102.3-36.15 133.53-55.47 154.29-6 6.45-8.66 14.16-8.61 21.71.11 16.4 12.98 32 32.1 32h383.8c19.12 0 32-15.6 32.1-32 .05-7.55-2.61-15.27-8.61-21.71z"></path>
                                </svg>
                                <span class="text-white bg-red-700 absolute rounded-full text-xs -mt-2.5 ml-2 py-0 px-1.5">1</span>
                            </a>
                            <!-- Settings Dropdown -->
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                            @auth()
                                                <a class="dropdown-toggle flex items-center hidden-arrow mr-2">
                                                    <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" class="rounded-full" style="height: 25px; width: 25px" alt="" loading="lazy" />
                                                </a>
                                                <div>{{ Auth::user()->name }}</div>
                                            @endauth

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('logout')">{{ __('Meus pedidos') }}</x-dropdown-link>
                                        <hr>
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                             onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                {{ __('Sair') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                            </div>
                            <div class="dropdown relative">

                            </div>
                            <div class="dropdown relative">

                            </div>
                        </div>
                    @else
                        <div class="flex items-center items-center lg:ml-auto">
                            <a class="inline-block px-6 py-2.5 mr-2 bg-transparent text-blue-600 font-medium text-xs leading-tight uppercase rounded hover:text-blue-700 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-0 active:bg-gray-200 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="{{ route('login') }}">Login</a>
                            <a class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light" href="{{ route('register') }}">Registre-se</a>
                        </div>
                    @endauth

                </div>
            </nav>

            {{ $slot }}

        </section>
    </body>
</html>
