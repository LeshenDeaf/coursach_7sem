<div class="sticky top-10 float-left w-1/6 wrap rounded-xl border border-gray-200 my-4 py-2">
    <div class="wrap_header text-center text-lg select-none">
        Categories
    </div>

    <div class="wrap_body hidden px-8 pt-2">
        <div class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200">
            <span class="hover:text-blue-400 transition-all">
                <a href="{{ route('home.forum.index') }}">
                    All
                </a>
            </span>
        </div>

        @foreach($categories as $category)
            <div class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200">
                <span class="hover:text-blue-400 transition-all">
                    <a href="{{ route('home.forum.category', $category->slug) }}">
                        {{ $category->name }}
                    </a>
                </span>
            </div>
        @endforeach
    </div>
</div>
