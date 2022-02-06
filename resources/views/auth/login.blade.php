@extends('layouts.app')

@section('content')
<div class="relative">
    <div class="w-1/2 rounded-xl mx-auto my-2 shadow-lg px-16 py-8">
        <div class="items-center">
            @include('partials.header_text', ['text' => __('Login')])

            <div class="items-center">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

{{--                    <div class="row mb-3">--}}
{{--                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>--}}

{{--                        <div class="col-md-6">--}}
{{--                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                            @error('email')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    @include('auth.partials.input', ['label' => 'email', 'name' => 'email', 'type' => 'email', 'value' => old('email'), 'isRequired' => true])
                    @include('auth.partials.input', ['label' => 'password', 'name' => 'password', 'type' => 'password', 'value' => old('password'), 'isRequired' => true])


{{--                    <div class="row mb-3">--}}
{{--                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                        <div class="col-md-6">--}}
{{--                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                            @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                </span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row mb-3">--}}
{{--                        <div class="col-md-6 offset-md-4">--}}
{{--                            <div class="form-check">--}}
{{--                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                <label class="form-check-label" for="remember">--}}
{{--                                    {{ __('Remember Me') }}--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

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
