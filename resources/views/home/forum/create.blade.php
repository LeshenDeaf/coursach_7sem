@extends('layouts.app')

@section('title', __('Creating thread'))

@section('content')
    @include("partials.header_text", ['text' => __('Creating thread'), 'classes' => 'text-center'])
    @include("partials.alerts.alert")

    <div class="items-center">
        <div class="rounded-xl bg-white shadow-lg w-1/2 mx-auto px-5 py-6">
            <form method="post" action="{{ route('home.forum.store') }}">
                @csrf
                <a href="{{ redirect()->back()->getTargetUrl() }}"
                   class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-blue-800 hover:bg-gray-50 px-3 py-1 rounded-xl"
                >
                    Back
                </a>

                @include('admin.users.partials.input', ['label' => 'Title', 'name' => 'title', 'isRequired' => true])

                <div class="text-slate-600 p-3">
                    <label>
                        <span class="block">Выберите категорию:</span>
                        <select name="category" class="text-slate-800">
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>

                @include('auth.partials.input', ['label' => 'Address', 'name' => 'addresses[]', 'value' => old('addresses[]'), 'autocomplete' => false, 'isRequired' => true,])

                <div class="p-3">
                    <label>
                        <textarea class="text-slate-800 py-2 px-4 rounded-xl border border-gray-300 w-full" name="text" cols="30" rows="10"></textarea>
                    </label>
                </div>

                <button class="rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </div>
@endsection
