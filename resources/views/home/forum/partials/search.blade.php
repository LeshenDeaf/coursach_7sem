<div class="sticky top-4 mx-auto w-[650px]">
    <div class="absolute  w-full">
        <div class="flex items-end content-end search">
            @include('home.forum.partials.address_input', ['label' => 'Address', 'autocomplete' => false, 'isRequired' => true,])

            <div class="">
                <div class="ml-4">
                    <button
                        class="find px-6 py-2 border bg-white border-gray-100 text-black rounded-xl shadow-lg hover:bg-gray-100 duration-100 transition-all"
                        type="button"
                    >
                        Найти
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
