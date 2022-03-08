<div class="text-slate-600 p-3">
    <label class="flex">
        {{ $label }}:
        <input class="@error( $name ?? '' ) is-invalid @enderror w-full text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none"
               value="{{ $value ?? '' }}"
               placeholder="Not filled"
               name="{{ $name ?? ''}}"
               type="{{ $type ?? 'text' }}"
               {{ ($isReadOnly ?? false) ? 'readonly' : '' }}
               {{ ($isRequired ?? false) ? 'required' : '' }}
               {{ ($autocomplete ?? '') ? 'autocomplete(' . ($name ?? '') . ')' : '' }}
        >
        @error( $name ?? '' )
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </label>
</div>
