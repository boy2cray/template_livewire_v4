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

    if (!$name) $name = uniqid('nama_');
    
    $allowedTypes = ['text','date','datetime-local','email','number','password','textarea','select'];
    if (!in_array($type, $allowedTypes)) $type = 'text';

    $fieldId = $id ?? Str::slug('field_' . $name);
    $errorId = $fieldId . '_error';
    $helpId = $fieldId . '_help';
    $hasError = $errors->has($name);

    $describedBy = trim(
        ($hasError ? $errorId . ' ' : '') .
        ($helpText ? $helpId : '')
    );

    $xModelAttr = $attributes->get('x-model') ?? null;
    $oldValue = old($name);
    $xInitAttr = null;
    if ($xModelAttr && $oldValue !== null && $oldValue !== '') {
        $jsonOld = json_encode($oldValue, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
        $xInitAttr = "{$xModelAttr} = {$jsonOld}";
    }
    $finalValue = old($name, $value);
    
    // --- 1. Kelas Input Dasar ---
    // Update: dark:bg-transparent dark:text-white dark:border-gray-600
    $baseClasses = 'peer block w-full rounded-lg border bg-transparent text-gray-900 dark:text-white transition-all duration-200 ease-in-out focus:outline-none';
    
    // Update: dark:bg-gray-700 dark:text-gray-400
    $disabledClass = $disabled ? 'bg-gray-100 text-gray-500 cursor-not-allowed dark:bg-gray-700 dark:text-gray-400' : 'dark:border-gray-600';
    
    // --- 2. Kelas Padding ---
    $paddingClass = $icon ? 'pl-10 pr-3' : 'px-3';
    $verticalPaddingClass = $floating ? 'pt-4 pb-2' : 'py-2.5';

    // --- 3. Kelas Status (Error / Focus) ---
    $stateClasses = $hasError
        ? 'border-red-500 focus:border-red-500 focus:ring-2 focus:ring-red-500/30'
        : 'border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 dark:focus:ring-blue-500/50'; 

    // --- 4. Gabungkan Semua Kelas Input ---
    $finalClasses = "$baseClasses $paddingClass $verticalPaddingClass $stateClasses $disabledClass";

    // --- 5. Kelas Ikon ---
    $iconBaseClasses = 'absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 pointer-events-none transition-colors duration-300';
    $iconColorClasses = $hasError
        ? 'text-red-400'
        : 'text-gray-400 peer-focus:text-blue-500 dark:text-gray-500 dark:peer-focus:text-blue-400';

    // --- 6. Kelas Label ---
    $labelBaseClasses = 'transition-all duration-300';
    $labelColorClasses = $hasError
        ? 'text-red-600 dark:text-red-400'
        : ($floating ? 'text-gray-500 peer-focus:text-blue-600 dark:text-gray-400 dark:peer-focus:text-blue-400' : 'text-gray-700 dark:text-gray-300');

    // Update: dark:bg-gray-800 (agar menutupi garis border di background gelap)
    $labelPositionClasses = $floating
        ? "absolute origin-left bg-white dark:bg-gray-800 px-1 pointer-events-none " . ($icon ? 'left-10' : 'left-3') . " top-1/2 -translate-y-1/2
           peer-focus:top-2 peer-focus:-translate-y-4 peer-focus:scale-75
           peer-not-placeholder-shown:top-2 peer-not-placeholder-shown:-translate-y-4 peer-not-placeholder-shown:scale-75"
        : "block mb-1 text-sm font-medium";

    $finalLabelClasses = "$labelBaseClasses $labelPositionClasses $labelColorClasses";
@endphp

<div class="w-full mb-4">

    @if ($label && !$floating)
        <label
            for="{{ $fieldId }}"
            class="{{ $finalLabelClasses }}"
        >
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <div class="relative">

        @switch($type)
            @case('textarea')
                <textarea
                    id="{{ $fieldId }}"
                    name="{{ $name }}"
                    rows="4"
                    placeholder="{{ $floating ? ' ' : $placeholder }}"
                    @if ($required) required @endif
                    @if ($readonly) readonly @endif
                    @if ($disabled) disabled @endif
                    @if ($inputmode) inputmode="{{ $inputmode }}" @endif
                    @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
                    @if ($xInitAttr) x-init="{{ $xInitAttr }}" @endif
                    class="{{ $finalClasses }} resize-none min-h-27.5 dark:bg-transparent"
                    {{ $attributes }}
                >{{ old($name, $value) }}</textarea>
            @break

            @case('select')
                <select
                    id="{{ $fieldId }}"
                    name="{{ $name }}"
                    @if ($required) required @endif
                    @if ($disabled) disabled @endif
                    @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
                    @if ($xInitAttr) x-init="{{ $xInitAttr }}" @endif
                    class="{{ $finalClasses }} appearance-none cursor-pointer dark:bg-transparent"
                    {{ $attributes }}
                >
                    <option value="" disabled {{ in_array($finalValue, [null, ''], true) ? 'selected' : '' }} class="dark:bg-gray-800">Pilih {{ strtolower($label ?: $name) }}</option>
                    
                    @foreach ($options as $key => $text)
                        <option value="{{ $key }}" {{ (!in_array($finalValue, [null, ''], true) && $finalValue == $key) ? 'selected' : '' }} class="dark:bg-gray-800">
                            {{ $text }}
                        </option>
                    @endforeach
                </select>

                <svg class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none dark:text-gray-500"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-width="1.5" d="M6 8l4 4 4-4"/>
                </svg>
            @break

            @default
                <input
                    id="{{ $fieldId }}"
                    name="{{ $name }}"
                    type="{{ $type }}"
                    @if(!in_array($finalValue, [null, ''], true)) value="{{ $finalValue }}" @endif
                    placeholder="{{ $floating ? ' ' : $placeholder }}"
                    autocomplete="{{ $autocomplete }}"
                    @if ($required) required @endif
                    @if ($readonly) readonly @endif
                    @if ($disabled) disabled @endif
                    @if ($maxlength) maxlength="{{ $maxlength }}" @endif
                    @if ($inputmode) inputmode="{{ $inputmode }}" @endif
                    @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
                    @if ($xInitAttr) x-init="{{ $xInitAttr }}" @endif
                    class="{{ $finalClasses }} dark:bg-transparent"
                    {{ $attributes }}
                />
        @endswitch

        @if ($icon)
            <x-icon :name="$icon"
                class="{{ $iconBaseClasses }} {{ $iconColorClasses }}" />
        @endif

        @if ($label && $floating)
            <label
                for="{{ $fieldId }}"
                class="{{ $finalLabelClasses }}"
            >
                {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
            </label>
        @endif
    </div>

    @if ($helpText)
        <p id="{{ $helpId }}" class="text-xs text-gray-500 mt-1.5 dark:text-gray-400">{{ $helpText }}</p>
    @endif

    @error($name, $errorBag)
        <p id="{{ $errorId }}" class="text-sm text-red-600 mt-1.5 font-medium dark:text-red-400">{{ $message }}</p>
    @enderror
</div>