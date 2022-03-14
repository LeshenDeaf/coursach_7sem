@extends('layouts.app')

@section('title', __('Filling ' . $form->name))

@section('content')
    @if(!$form)
        Form is not defined
    @elseif(empty($form->fields->toArray()))
        Form fields does not exist
    @else
        @include("partials.header_text", ['text' => $form->name, 'classes' => 'text-center'])
        @include("partials.alerts.alert")

        <div class="items-center">
            <div class="rounded-xl bg-white shadow-lg w-1/2 mx-auto px-5 py-6">
                <form method="post" action="{{ route('home.answers.store_results', $form->id) }}">
                    @method('POST')
                    @csrf

                    <a href="{{ back() }}"
                       class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-blue-800 hover:bg-gray-50 px-3 py-1 rounded-xl"
                    >
                        Back
                    </a>


                    @foreach($form->fields as $field)
                        @include('home.answers.partials.input', ['field' => $field])
                    @endforeach

                    <button class="rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    @endif

@endsection
