@extends('layouts.app')

@section('title', __('Filling ' . $form->name))

@section('content')
    @if(!$form)
        Form is not defined
    @elseif(empty($form->fields->toArray()))
        <h1 class="text-center text-black text-xl my-8">Form is empty <br><span class="text-gray-600">(no fields attached for it)</span></h1>
        <a href="{{ redirect()->back()->getTargetUrl() }}"
           class="mx-auto w-fit block font-bold text-xl text-gray-500 hover:text-blue-800 hover:bg-gray-50 px-3 py-1 rounded-xl"
        >
            Back
        </a>
    @else
        @include("partials.header_text", ['text' => $form->name, 'classes' => 'text-center'])
        @include("partials.alerts.alert")

        <div class="items-center">
            <div class="rounded-xl bg-white shadow-lg w-1/2 mx-auto px-5 py-6">
                <form method="post" action="{{ route('home.answers.store_results', $form->id) }}">
                    @method('POST')
                    @csrf

                    <a href="{{ redirect()->back()->getTargetUrl() }}"
                       class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-blue-800 hover:bg-gray-50 px-3 py-1 rounded-xl"
                    >
                        Back
                    </a>

                    @foreach(\App\Models\Field::$types as $typeName => $type)
                        @if(!isset($form->fields[$type]))
                            @continue
                        @endif
                        <div class="wrap rounded-xl border border-gray-200 my-4 py-2">
                            <div class="wrap_header text-center text-lg select-none">{{ \App\Models\Field::getTypeLabel($type) }}s</div>

                            <div class="wrap_body hidden">
                                @foreach($form->fields[$type] as $field)
                                    @include('home.answers.partials.input', ['field' => $field])
                                @endforeach
                            </div>

                        </div>

                    @endforeach

                    <button class="rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
        </div>
    @endif

@endsection
