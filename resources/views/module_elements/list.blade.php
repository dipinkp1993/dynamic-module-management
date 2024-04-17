<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'List ' . $module_name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex justify-end">
        <p class="text-xl pb-3 flex items-center">
                                <x-button rose icon-right="plus" class="mt-2" href="{{route('module.create',$module_name)}}" wire:navigate> <i class="fas fa-plus mr-3"></i> Create
                            {{$module_name }}</x-button>
                        </p>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Sl No
                                </th>
                                @foreach ($fields as $field)
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    {{ $field->label }}
                                </th>
                                @endforeach
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Edit
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($pagedResults as $result)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ ($pagedResults->currentPage()-1) * $pagedResults->perPage() + $loop->index + 1 }}</td>
                                @foreach ($fields as $field)
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($field->reference_module!=NULL)
                               
                                   {{ DB::table($field->reference_module)->where('value_code', $result->{'field_' . $field->id})->first()->module_field_value }}
                                @else
                                   {{ $result->{'field_' . $field->id} }}
                                @endif
                                </td>
                                @endforeach
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="{{ route('module.edit', ['module_name' => $module_name, 'value_code' => $result->value_code]) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $pagedResults->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
