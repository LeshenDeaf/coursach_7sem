<div class="flex justify-center">
    <div>
        <div class="form-check">
            <input class="form-checkbox h-4 w-4 border border-gray-300 rounded-lg bg-white text-blue-600 focus:outline-none transition duration-200 mt-1 align-top float-left mr-2 cursor-pointer"
                   type="checkbox"
                   value="{{ $value ?? '' }}"
                   name="{{ $name ?? '' }}"
                   {{ $checked ? 'checked' : '' }}
                   id="{{ $name ?? '' }}"
            >
            <label class="form-check-label inline-block text-gray-800" for="{{ $name ?? '' }}">
                {{ $label ?? '' }}
            </label>
        </div>
    </div>
</div>

