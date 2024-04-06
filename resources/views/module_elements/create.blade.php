<x-app-layout>
    <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{'Create '.$module_name}}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{route('module.store',$module_name)}}" method="POST"   class="space-y-4">
                @csrf
                    @foreach($fields as $index=>$field)
                        @if($fields[$index]->field->field_type === 'textarea')
                            <x-textarea name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" required />
                        @endif
                        @if($fields[$index]->field->field_type === 'text')
                            <x-input name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" required/>
                        @endif
                        @if($fields[$index]->field->field_type === 'email')
                            <x-input name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" type="email" required />
                        @endif
                        @if($fields[$index]->field->field_type === 'number')
                            <x-input name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" type="number" required />
                        @endif
                        @if($fields[$index]->field->field_type === 'date')
                            <x-input name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" type="date" required />
                        @endif
                        @if($fields[$index]->field->field_type === 'select')
                            <select class= "check placeholder-secondary-400 dark:bg-secondary-800 dark:text-secondary-400 dark:placeholder-secondary-500 border border-secondary-300 focus:ring-primary-500 focus:border-primary-500 dark:border-secondary-600 form-input block w-full sm:text-sm rounded-md transition ease-in-out duration-100 focus:outline-none shadow-sm" name="{{ $fields[$index]->name }}"   label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}"  required>
                            <option value="">{{ $fields[$index]->label }}</option>
                                @if($fields[$index]->reference_module!=NULL)
                                    @php
                                     $referenceValues=getModuleValues($fields[$index]->reference_module);
                                    @endphp
                                    @foreach ($referenceValues as $value) 
                                     <option value="{{$value[0]}}">{{@$value[1] }}</option>
                                    @endforeach
                                @else
                                    @php
                                     $options=DB::table('module_select_options')->where('module_field_id',$fields[$index]->id)->get();
                                    @endphp
                                    @forelse($options as $option)
                                     <option value="{{$option->option_value}}">{{$option->option_label}}</option>
                                    @empty
                                     <option value="">No Data available</option>
                                    @endforelse
        
                                @endif
                            </select>
                        @endif
                    @endforeach
                    <div class="pt-4">
                       <x-button  warning right-icon="calendar" type="submit">Submit</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
