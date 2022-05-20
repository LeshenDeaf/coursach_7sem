<div class="add_counter">
    <input type="hidden" name="address_id" value="{{ $address->id }}">
    @include('auth.partials.input', ['label' => 'Регистрационный номер типа СИ', 'name' => 'register_type', 'type' => 'text', 'value' => old('register_type'), 'isRequired' => false])
    @include('auth.partials.input', ['label' => 'Заводской номер СИ', 'name' => 'factory_number', 'type' => 'text', 'value' => old('factory_number'), 'isRequired' => false])
    <button type="button"
            class="w-full border-blue-700 py-2 px-4 font-medium text-white bg-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-700">
        <i class="animate-spin fck-spinner inline-block hidden"></i>Add counter
    </button>
</div>
