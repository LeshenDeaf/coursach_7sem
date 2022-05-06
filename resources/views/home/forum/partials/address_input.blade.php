<div class="text-slate-600 w-full">
    <label>
        <span class="block">{{ $label }}</span>
        <input class="@error('addresses[]') is-invalid @enderror text-slate-800 py-2 px-4 hover:text-blue-900 hover:bg-gray-100 hover:border-blue-400 rounded-lg cursor-pointer border-blue-300 border focus:border-blue-600 focus:ring-0 focus:outline-none w-full"
               value="{{ $value ?? old('addresses[]') }}"
               placeholder="Not filled"
               name="addresses[]"
               type="text"
               autocomplete="off"
            {{ ($isRequired ?? false) ? 'required' : '' }}
        >
        @error('addresses[]')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </label>
</div>
