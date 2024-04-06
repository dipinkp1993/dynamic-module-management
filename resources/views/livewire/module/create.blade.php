<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
new #[Layout('layouts.app')] class extends Component {
    public $module_name;
    public $fields;

    public function mount($module_name)
    {
        $this->module_name = $module_name;
        $this->fields = getModuleFields($module_name);
        $this->count_of_fields= count($this->fields);
        //dd($this->fields[1]->field,$this->count_of_fields);
    }
    public function saveEntity()
    {
        dd('hii');
        
        //$this->redirect(route('customers.index', absolute: false), navigate: true);
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{'Create '.$module_name}}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form wire:submit='saveEntity'  class="space-y-4">
                    @foreach($fields as $index=>$field)
                        @if($fields[$index]->field->field_type === 'textarea')
                            <x-textarea wire:model="fields.{{$index}}.{{ $fields[$index]->name }}" label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" required />
                        @endif
                        @if($fields[$index]->field->field_type === 'text')
                            <x-input wire:model="fields.{{$index}}.{{ $fields[$index]->name }}" label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" />
                        @endif
                        @if($fields[$index]->field->field_type === 'email')
                            <x-input wire:model="fields.{{$index}}.{{ $fields[$index]->name }}" label="{{ $fields[$index]->label }}" placeholder="{{ $fields[$index]->label }}" type="email" />
                        @endif
                    @endforeach
                    <div class="pt-4">
                       <x-button  warning right-icon="calendar">Update Product</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

