<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Customer;

new class extends Component {
    use WithPagination;
    public function with(): array
    {
        return [
            'customers' => Customer::orderBy('created_at','DESC')->paginate(10),
        ];//loading blade view with this function to load customers
    }
    
}; ?>

<div>
      <div class="w-full mt-12">
      @if (session('status'))
      <div id="alert" class="rounded-md p-4 bg-green-100 border-green-400 border">
    <div class="flex">
        <div class="flex-shrink-0">
            <!-- Heroicon name: exclamation -->
            <svg class="h-5 w-5 text-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12zm-1-9a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1zm0 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-yellow-700">
                {{(session('status'))}}
            </p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button id="dismissBtn" class="inline-flex rounded-md p-1.5 text-yellow-500 hover:bg-yellow-200 focus:outline-none focus:bg-yellow-200 transition ease-in-out duration-150">
                    <!-- Heroicon name: x -->
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M14.879 5.464a2 2 0 10-2.828-2.828L10 7.172 7.95 5.122a2 2 0 10-2.828 2.828L7.172 10l-2.05 2.05a2 2 0 102.828 2.828L10 12.828l2.05 2.05a2 2 0 102.828-2.828L12.828 10l2.051-2.05z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endif
      @if($customers->isEmpty())
            
            <div class="text-center">
             <x-action-message on="product-deleted" />
                <p class="text-xl font-bold">No Customer yet</p>
                <p class="text-sm">Let's create your first Customer</p>
                <x-button rose icon-right="plus" class="mt-6" href="{{route('customers.create')}}" wire:navigate><i class="fas fa-plus mr-3"></i>Create
                    Customers</x-button>
            </div>
      @else
                   <div class="flex justify-end">
                        <p class="text-xl pb-3 flex items-center">
                            <x-button rose icon-right="plus" class="mt-2" href="{{route('customers.create')}}" wire:navigate> <i class="fas fa-plus mr-3"></i> Create
                        Customer</x-button>
                    </p>
                    </div>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                   <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Sl No
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Phone
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Edit
                                    </th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $index=>$customer)
                                <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ ($customers->currentPage()-1) * $customers->perPage() + $loop->index + 1 }} </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="flex items-center">
                                            
                                            <div class="ml-3">
                                                <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$customer->customer_name}}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"> {{@$customer->customer_email}}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                             {{@$customer->customer_phone}}
                                        </p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                     <x-button.circle rose  icon="pencil"
                                    href="{{route('customers.edit',$customer)}}" wire:navigate tooltip="Edit"></x-button.circle>
                                    </td>
                                   
                                </tr>
                            @endforeach
                              
                            </tbody>
                        </table>
                        {{ $customers->links() }}
                    </div>
                 @endif   
                </div>
    
</div>
<script>
    document.getElementById('dismissBtn').addEventListener('click', function() {
        document.getElementById('alert').style.display = 'none';
    });
</script>
