@extends('layouts.app')

@section('title', 'Creation of user')

@section('content')
    @include('partials.header_text', ['text' => 'Creating user', 'classes' => 'text-center'])

    @include("partials.alerts.alert")

    <div class="items-center">
        <div class="rounded-xl bg-white shadow-lg w-1/2 mx-auto px-5 py-6">
            <form method="post" action="{{ route('admin.users.store') }}">
                @csrf
                <a href="{{ route('admin.users.index') }}"
                   class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-blue-800 hover:bg-gray-50 px-3 py-1 rounded-xl"
                >
                    Back
                </a>
                @include('admin.users.partials.input', ['label' => 'Name', 'name' => 'name', 'isRequired' => true])
                @include('admin.users.partials.input', ['label' => 'Email', 'type' => 'email', 'name' => 'email', 'isRequired' => true, 'autocomplete' => false])
                @include('admin.users.partials.input', ['label' => 'Password', 'type' => 'password', 'name' => 'password', 'isRequired' => true, 'autocomplete' => false])
                @include('admin.users.partials.input', ['label' => 'Address', 'name' => 'addresses[]', 'value' => old('addresses[]'), 'autocomplete' => false, 'isRequired' => true,])
                @include('admin.users.partials.list_input', ['label' => 'Roles'])

                <button class="rounded-xl bg-blue-500 text-white w-full py-2 my-2 hover:bg-blue-600 transition shadow-lg hover:shadow-none">
                    {{ __('Submit') }}
                </button>
            </form>
        </div>
    </div>

@endsection
