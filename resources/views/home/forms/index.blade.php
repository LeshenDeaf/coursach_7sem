@extends('layouts.app')

@section('content')
    <a href="{{ route('home.forms.create') }}"
       class="float-right px-8 py-3 bg-blue-500 text-white rounded-xl shadow-lg hover:bg-blue-700 duration-100 transition-all"
    >
        Create
    </a>

    @include("partials.header_text", ['text' => __('Forms')])


    @include("partials.alerts.alert")


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    @foreach ($forms as $form)
                        {{ $form }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
