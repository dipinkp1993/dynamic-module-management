<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ 'Edit ' . $module_name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('module.update', ['module_name' => $module_name, 'value_code' => $entity->first()->value_code]) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        @foreach($fields as $field)
                            @if($field->field->field_type === 'textarea')
                                <x-textarea name="{{ $field->name }}" label="{{ $field->label }}" placeholder="{{ $field->label }}" required>{{ @$entity->where('module_field_id', $field->id)->first()->module_field_value }}</x-textarea>
                            @elseif($field->field->field_type === 'text')
                                <x-input name="{{ $field->name }}" label="{{ $field->label }}" placeholder="{{ $field->label }}" required value="{{ @$entity->where('module_field_id', $field->id)->first()->module_field_value }}" />
                            @elseif($field->field->field_type === 'email')
                                <x-input name="{{ $field->name }}" label="{{ $field->label }}" placeholder="{{ $field->label }}" type="email" required value="{{ @$entity->where('module_field_id', $field->id)->first()->module_field_value }}" />
                            @endif
                            @if($field->field->field_type === 'number')
                            <x-input name="{{ $field->name }}"   label="{{ $field->label }}" placeholder="{{ $field->label }}" type="number" required value="{{ @$entity->where('module_field_id', $field->id)->first()->module_field_value }}" />
                        @endif
                        @if($field->field->field_type === 'date')
                            <x-input name="{{ $field->name }}"   label="{{ $field->label }}" placeholder="{{ $field->label }}" type="date" required value="{{ @$entity->where('module_field_id', $field->id)->first()->module_field_value }}" />
                        @endif
                        @if($field->field->field_type === 'select')
                        {{ $field->label }}
                            <select class= "check placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm" name="{{ $field->name }}"   label="{{ $field->label }}" placeholder="{{ $field->label }}"  required>
                            <option value="">{{ $field->label }}</option>
                                @if($field->reference_module!=NULL)
                                    @php
                                    $referenceValues=getModuleValues($field->reference_module);
                                    @endphp
                                        @foreach (@$referenceValues as $value) 
                                       <option value="{{@$value[0]}}" {{ (@$value[0]==@$entity->where('module_field_id', $field->id)->first()->module_field_value  ? 'selected' : '') }}>{{ @$value[1] }}</option>

                                        @endforeach
                                @else
                                 @php
                                     $options=DB::table('module_select_options')->where('module_field_id',$field->id)->get();
                                    @endphp
                                    @forelse($options as $option)
                                     <option value="{{$option->option_value}}"  {{ ($option->option_value==$entity->where('module_field_id', $field->id)->first()->module_field_value  ? 'selected' : '') }}>{{$option->option_label}}</option>
                                    @empty
                                     <option value="">No Data available</option>
                                    @endforelse
                                @endif
                            </select>
                        @endif
                        @endforeach
                        <div class="pt-4">
                            <x-button warning right-icon="calendar" type="submit">Update</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
