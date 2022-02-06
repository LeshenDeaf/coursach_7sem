<div class="text-slate-600 p-3">
    <label>
        <span class="block">{{ $label }}</span>
        <input class="@error($name) is-invalid @enderror text-slate-800 py-2 px-4 hover:text-blue-900 hover:bg-gray-100 hover:border-blue-400 rounded-lg cursor-pointer border-blue-300 border focus:border-blue-600 focus:ring-0 focus:outline-none w-full"
               value="{{ $value ?? '' }}"
               placeholder="Not filled"
               name="{{ $name ?? '' }}"
               type="{{ $type ?? 'text' }}"
               {{ ($isReadOnly ?? false) ? 'readonly' : '' }}
               {{ ($isRequired ?? false) ? 'required' : '' }}
        >
        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </label>
</div>
