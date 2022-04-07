@extends('layouts.app')

@section('title', __('Answers for you'))

@section('content')
    @include("partials.header_text", ['text' => "Your answers"])


    @include("partials.alerts.alert")


    @foreach($grouped as $address => $group)
        <div class="text-center text-lg text-gray-500 bg-gray-50 pt-3 px-6 rounded-t-xl block w-fit mx-auto shadow-lg border border-b-0">
            Answers for <span class="text-black">"{{ $address }}"</span>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    When answered
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Field
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Answer
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($group as $index => $answer)
                                    <?php $field = $answer->field; ?>
                                    <tr class="bg-white divide-y divide-gray-200">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-900">
                                                    {{ date('d.m.Y', strtotime($answer->created_at)) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-900">
                                                    {{ $field->label }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="font-medium text-gray-900">
                                                    {{ \App\Models\Field::getTypeLabel($field->type) }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-gray-900">
                                                {{ $answer->answer }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <button class="destroy_answer text-red-400 hover:text-red-500" value="{{ $answer->id }}">
                                                {{ __('Delete') }}
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
