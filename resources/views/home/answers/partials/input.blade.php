<?php
$fieldType = \App\Models\Field::getTypeName($field->type);
?>

<div class="text-slate-600 p-3">
    <label class="flex">
        {{ $field->label }}:
        <input class="@error( $field->name ?? '' ) is-invalid @enderror input_{{ $fieldType }} w-full text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none"
               value="{{ $value ?? '' }}"
               placeholder="Not filled"
               name="{{ $field->name }}"
               type="{{ $type ?? 'text' }}"
               required
               autocomplete({{ $field->name }})
        >
        @error( $field->name ?? '' )
        <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </label>
</div>
