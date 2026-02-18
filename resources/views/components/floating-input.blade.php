@props([
    'id' => null,
    'name' => null,
    'label' => '',
    'type' => 'text',
    'value' => '',
    'required' => false,
    'options' => [],
    'icon' => null,
    'helpText' => null,
    'maxlength' => null,
    'inputmode' => null,
    'readonly' => false,
    'disabled' => false,
    'placeholder' => '',
    'floating' => true,
    'autocomplete' => 'off',
])

@aware(['errorBag' => 'default'])

@php
    use Illuminate\Support\Str;

    $name ??= uniqid('field_');

    $allowedTypes = ['text','date','datetime-local','email','number','password','textarea','select'];
    $type = in_array($type, $allowedTypes) ? $type : 'text';

    $fieldId = $id ?? Str::slug('input_'.$name);
    $errorId = $fieldId.'_error';
    $helpId  = $fieldId.'_help';

    $hasError = $errors->has($name);
    $finalValue = old($name, $value);

    // Accessibility IDs
    $describedBy = collect([
        $hasError ? $errorId : null,
        $helpText ? $helpId : null,
    ])->filter()->implode(' ');

    /* ==========================
        STYLE CONFIG
    ========================== */
    
    // Base Input Style: Modernized with shadow, better transition, and background handling
    $baseInput = 'peer block w-full rounded-lg text-sm shadow-sm transition-all duration-200 ease-in-out focus:outline-none disabled:opacity-75 disabled:cursor-not-allowed';
    
    // Background & Text Colors
    $colors = 'bg-white text-gray-900 dark:bg-gray-900 dark:text-white placeholder-transparent';
    if ($disabled) {
        $colors = 'bg-gray-50 text-gray-500 dark:bg-gray-800 dark:text-gray-400';
    }

    // Border & Focus States
    if ($hasError) {
        $border = 'border-red-500 focus:border-red-500 focus:ring-4 focus:ring-red-500/10';
    } else {
        $border = 'border-gray-300 hover:border-gray-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10 dark:border-gray-700 dark:hover:border-gray-600 dark:focus:border-blue-500';
    }

    // Padding Logic
    $paddingX = $icon ? 'pl-11 pr-4' : 'px-4'; // Sedikit lebih lebar untuk estetika
    $paddingY = $floating ? 'pt-6 pb-2' : 'py-3';

    // Gabungkan Class Input
    $inputClass = "$baseInput $colors $border $paddingX $paddingY";

    // Label Styling
    $labelBase = 'absolute pointer-events-none transition-all duration-200 ease-out origin-[0] z-10 truncate max-w-[calc(100%-2rem)]';
    
    // Floating Logic: Adjusted translation for perfect vertical alignment on border
    $labelFloating = ($icon ? 'left-11' : 'left-4').' top-4
        peer-focus:top-0.5 peer-focus:scale-75 peer-focus:-translate-y-0
        peer-not-placeholder-shown:top-0.5 peer-not-placeholder-shown:scale-75 peer-not-placeholder-shown:-translate-y-0';

    // Label Colors
    if ($hasError) {
        $labelColor = 'text-red-500 dark:text-red-400';
    } else {
        $labelColor = 'text-gray-500 peer-focus:text-blue-600 dark:text-gray-400 dark:peer-focus:text-blue-400';
    }

    // Final Label Class
    $labelClass = $floating
        ? "$labelBase $labelFloating $labelColor"
        : 'block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-200';

@endphp

<div class="w-full mb-5 group">
    {{-- Static Label (Non-floating) --}}
    @if ($label && !$floating)
        <label for="{{ $fieldId }}" class="{{ $labelClass }}">
            {{ $label }} @if($required)<span class="text-red-500 select-none">*</span>@endif
        </label>
    @endif

    <div
        class="relative"
        x-data="{
            raw: @entangle($attributes->wire('model')),
            display: '',
            isNumber: '{{ $type }}' === 'number',
            format(v) {
                if (!this.isNumber || v === null || v === undefined) return v;
                // Format: 1.000.000
                return v.toString().replace(/\D/g,'').replace(/\B(?=(\d{3})+(?!\d))/g,'.');
            },
            init() {
                if (this.isNumber) {
                    this.display = this.format(this.raw);
                    this.$watch('raw', v => this.display = this.format(v));
                }
            }
        }"
        x-modelable="raw"
    >
        {{-- TEXTAREA --}}
        @if ($type === 'textarea')
            <textarea
                id="{{ $fieldId }}"
                name="{{ $name }}"
                rows="4"
                x-model="raw"
                aria-describedby="{{ $describedBy }}"
                {{ $disabled ? 'disabled' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                placeholder="{{ $floating ? ' ' : $placeholder }}"
                class="{{ $inputClass }} resize-y min-h-20"
                {{ $attributes->whereDoesntStartWith(['wire:model','x-model']) }}
            >{{ $finalValue }}</textarea>

        {{-- SELECT --}}
        @elseif ($type === 'select')
            <select
                id="{{ $fieldId }}"
                name="{{ $name }}"
                x-model="raw"
                aria-describedby="{{ $describedBy }}"
                class="{{ $inputClass }} appearance-none cursor-pointer"
                {{ $disabled ? 'disabled' : '' }}
                {{ $attributes->whereDoesntStartWith(['wire:model','x-model']) }}
            >
                <option value="" disabled selected class="text-gray-400">{{ $placeholder ?: '' }}</option>
                @foreach ($options as $key => $text)
                    <option value="{{ $key }}" class="text-gray-900 dark:text-white">{{ $text }}</option>
                @endforeach
            </select>

            {{-- Custom Chevron for Select --}}
            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none flex items-center">
                <svg class="w-5 h-5 text-gray-400 transition-colors group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                </svg>
            </div>

        {{-- STANDARD INPUT (TEXT/NUMBER/ETC) --}}
        @else
            <input
                id="{{ $fieldId }}"
                type="{{ $type === 'number' ? 'text' : $type }}"
                name="{{ $name }}"
                aria-describedby="{{ $describedBy }}"
                autocomplete="{{ $autocomplete }}"
                {{ $disabled ? 'disabled' : '' }}
                {{ $readonly ? 'readonly' : '' }}
                {{ $attributes->whereDoesntStartWith(['wire:model','x-model']) }}

                @if($type === 'number')
                    x-model="display"
                    inputmode="numeric"
                    @input="raw = $event.target.value.replace(/\D/g,'')"
                @else
                    x-model="raw"
                @endif

                placeholder="{{ $floating ? ' ' : $placeholder }}"
                class="{{ $inputClass }}"
            />
        @endif

        {{-- ICON --}}
        @if ($icon)
            <div class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none">
                <x-icon
                    :name="$icon"
                    class="w-5 h-5 transition-colors duration-200
                    {{ $hasError ? 'text-red-500' : 'text-gray-400 peer-focus:text-blue-600 dark:text-gray-500 dark:peer-focus:text-blue-500' }}"
                />
            </div>
        @endif

        {{-- FLOATING LABEL --}}
        @if ($label && $floating)
            <label for="{{ $fieldId }}" class="{{ $labelClass }}">
                {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
            </label>
        @endif
    </div>

    {{-- HELP TEXT --}}
    @if ($helpText)
        <div id="{{ $helpId }}" class="mt-1.5 flex items-start gap-1.5 text-xs text-gray-500 dark:text-gray-400">
            <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="leading-relaxed">{{ $helpText }}</span>
        </div>
    @endif

    {{-- ERROR MESSAGE --}}
    @error($name, $errorBag)
        <div id="{{ $errorId }}" class="mt-1.5 flex items-center gap-1.5 text-sm font-medium text-red-600 dark:text-red-400 animate-pulse">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ $message }}</span>
        </div>
    @enderror
</div>