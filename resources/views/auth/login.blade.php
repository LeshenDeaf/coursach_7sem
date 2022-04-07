@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="w-1/2 rounded-xl mx-auto my-2 shadow-lg px-16 py-8">
        <div class="items-center">
            @include('partials.header_text', ['text' => __('Login')])

            <div class="items-center">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @include('auth.partials.input', ['label' => 'email', 'name' => 'email', 'type' => 'email', 'value' => old('email'), 'isRequired' => true])
                    @include('auth.partials.input', ['label' => 'password', 'name' => 'password', 'type' => 'password', 'value' => old('password'), 'isRequired' => true])

                    @include('partials.inputs.checkbox', ['label' => __('Remember Me'), 'name' => 'remember', 'value' => 'true', 'checked' => old('remember')])


                    <div class="inline-flex rounded-md shadow-sm w-full my-2" role="group">
                        <button type="submit"
                                class="w-full border-r border-blue-700 py-2 px-4 font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 ">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="w-full py-2 px-4 font-medium text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 "
                               href="{{ route('password.request') }}"
                            >
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
