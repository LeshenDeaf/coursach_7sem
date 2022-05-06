<div class="sticky top-4 mx-auto w-[750px] mb-3">
    <div class="absolute  w-full py-2 px-3 border shadow-lg rounded-lg bg-white">
        <div class="flex items-start content-start search">
            @include('home.forum.partials.address_input', ['label' => 'Address', 'autocomplete' => false, 'isRequired' => true, 'value' => $address ?? ''])

            <div class="">
                <div class="ml-4 mt-6">
                    <button
                        class="find px-6 py-2 bg-blue-500 rounded-xl text-white hover:bg-blue-700 duration-100 transition-all"
                        type="button"
                    >
                        Найти
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
