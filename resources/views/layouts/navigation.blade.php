<?php

$auth_user = null;
$user_type = 0;
if((Auth::user()) != null) {
    $auth_user = Auth::user();
    $user_type = 1; 
} else if(Auth::guard('admin')->user() != null) {
    $auth_user = Auth::guard('admin')->user();
    $user_type = 2;
}

?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if($user_type === 1)
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" class="rounded mx-auto d-block" width="200" alt="">
                    </a>
                    @elseif($user_type === 2)
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('images/logo.png') }}" class="rounded mx-auto d-block" width="200" alt="">
                    </a>
                    @endif
                </div>

                <!-- Navigation Links -->
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 ">
                            <?php
                                $pesanan_utama = \App\Models\Pesanan::where('user_id', $auth_user->id)->where('status',0)->first();
                                if(!empty($pesanan_utama))
                                {
                                    $notif = \App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count(); 
                                }
                            ?>
                            @if($user_type === 1)
                            <a class="nav-link" href="{{ url('check-out') }}">
                                <i class="fa fa-shopping-cart fa-lg"></i>
                                @if(!empty($notif))
                                <span class="badge badge-danger">{{ $notif }}</span>
                                @endif
                            </a>
                            @endif
                            </button>
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ $auth_user->name }}</div>


                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        @if($user_type === 1)
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @endif

                        @if($user_type === 1)
                            <x-dropdown-link :href="route('history')">
                                {{ __('My Order') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        @if($user_type === 1)
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                        <!--Incoming Order -->
                        @if($user_type === 2)
                            <x-dropdown-link :href="route('incoming-order')">
                                {{ __('Incoming Order') }}
                            </x-dropdown-link>
                        @endif

                        <!--Add Product-->
                        @if($user_type === 2)
                            <x-dropdown-link :href="route('incoming-order')">
                                {{ __('Add Product') }}
                            </x-dropdown-link>
                        @endif

                        @if($user_type === 2)
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('admin.logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @endif
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ $auth_user->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ $auth_user->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                @if($user_type === 1)
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @endif
            
                @if($user_type === 1)
                <x-responsive-nav-link :href="route('history')">
                    {{ __('Order History') }}
                </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                @if($user_type === 1)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endif
                @if($user_type === 2)
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('admin.logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>
