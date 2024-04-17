<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
   
}; ?>

<aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('dashboard') }}" wire:navigate  class="@if(request()->routeIs('dashboard'))active-nav-link @endif flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            <a href="{{route('module.list','customers')}}"  wire:navigate class="flex items-center @if(request()->routeIs('customers.index'))active-nav-link @endif text-white py-4 pl-6 nav-item">
                <i class="fas fa-sticky-note mr-3"></i>
                Customers
            </a>
            <a href="{{route('module.list','invoices')}}" wire:navigate class="flex items-center @if(request()->routeIs('invoices.index'))active-nav-link @endif text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-table mr-3"></i>
                Invoices
            </a>
           
        </nav>
        
    </aside>

