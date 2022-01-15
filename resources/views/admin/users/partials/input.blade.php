<div class="text-slate-600 p-3">
    <label>
        {{ $label }}:
        <input class="text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none"
               value="{{ $value ?? '' }}"
               placeholder="Not filled"
               name="{{ $name ?? '' }}"
               {{ ($isReadOnly ?? false) ? 'readonly' : '' }}
               {{ ($isRequired ?? false) ? 'required' : '' }}
        >
    </label>
</div>
