@extends('layouts.app')

@section('content')
    <a href="{{ route('home.forms.create') }}"
       class="float-right px-8 py-3 bg-blue-500 text-white rounded-xl shadow-lg hover:bg-blue-700 duration-100 transition-all"
    >
        Create
    </a>

    @include("partials.header_text", ['text' => __('Forms')])

    @include("partials.alerts.alert")

    <div class="flex flex-row">
        @foreach ($forms as $form)
            <div class="my-2 w-1/3 mx-8">
                <div class="py-4 align-middle inline-block min-w-full sm:px-6 lg:px-8 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="text-2xl text-center mb-6">{{ $form->name }}</div>

                    <a class="w-full my-2 py-2 text-center bg-blue-500 hover:bg-blue-700 text-white rounded-xl block"
                       href="{{ route('home.answers.fill_form', $form->id) }}"
                    >
                        Fill form
                    </a>

                    <a class="w-full my-2 py-2 text-center bg-blue-500 hover:bg-blue-700 text-white rounded-xl block"
                       href="{{ route('home.forms.edit', $form->id) }}"
                    >
                        Edit
                    </a>

                    <form action="{{ route('home.forms.destroy', $form->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="w-full my-2 py-2 text-center bg-red-400 hover:bg-red-700 text-white rounded-xl block">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
