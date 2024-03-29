<?php
$fieldType = \App\Models\Field::getTypeName($field->type);
$fieldTypeLabel = \App\Models\Field::getTypeLabel($field->type);
?>

<div class="text-slate-600 p-3">
    <label class="">
        <span class="block">{{ $field->label }}:</span>

        <input class="@error( $field->name ?? '' ) is-invalid @enderror input_{{ $fieldType }} w-full text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none"
               value="{{ old( $field->name . '_' . $fieldType) }}"
{{--               placeholder="Not filled"--}}
               name="{{ $field->name }}_{{ $fieldType }}"
               type="{{ $type ?? 'text' }}"
               placeholder="{{ $fieldTypeLabel }}"
               required
               autocomplete({{ $field->name }}_{{ $fieldType }})
        >
        @error( $field->name ?? '' )
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </label>
</div>
