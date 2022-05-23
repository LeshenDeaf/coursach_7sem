<div class="auth_esplus sticky top-10 float-left w-1/6 wrap rounded-xl border border-gray-200 my-4 py-2 make_wider">
    <div class="wrap_header text-center text-lg select-none">
        It's available for you to auth in ESPlus
    </div>

    <div class="wrap_body hidden px-0 pt-2">
        <div
            class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200 hover:text-blue-400 transition-all">
            @include('auth.partials.input', ['label' => 'Login', 'name' => 'login', 'isRequired' => true, 'autocomplete' => false])
        </div>

        <div
            class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200 hover:text-blue-400 transition-all">
            @include('auth.partials.input', ['label' => 'Password', 'name' => 'password', 'type' => 'password', 'isRequired' => true, 'autocomplete' => false])
        </div>

        <div class="px-2">
            <button
                class="es_auth_btn rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none"
                type="button"
            >
                {{ __('Submit') }}
            </button>
        </div>
    </div>
</div>
