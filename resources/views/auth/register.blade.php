@extends('layouts.app')

@section('content')
<div class="container">
    <div class="w-1/2 rounded-xl mx-auto my-2 shadow-lg px-16 py-8">
{{--                <div class="card-header">{{ __('Register') }}</div>--}}
        @include('partials.header_text', ['text' => __('Register')])

        <div class="items-center">
            <form method="POST" action="{{ route('register') }}">
                @csrf

{{--                <div class="row mb-3">--}}
{{--                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                        @error('name')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

                @include('auth.partials.input', ['label' => 'Name', 'name' => 'name', 'value' => old('name'), 'autocomplete' => true, 'isRequired' => true,])
                @include('auth.partials.input', ['label' => 'E-Mail address', 'type' => 'email', 'name' => 'email', 'value' => old('email'), 'autocomplete' => true, 'isRequired' => true,])
                @include('auth.partials.input', ['label' => 'Password', 'type' => 'password', 'name' => 'password', 'value' => old('password'), 'isRequired' => true,])
                @include('auth.partials.input', ['label' => 'Confirm Password', 'type' => 'password', 'name' => 'password_confirmation', 'value' => old('password_confirmation'), 'isRequired' => true,])

{{--                <div class="row mb-3">--}}
{{--                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                        @error('email')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row mb-3">--}}
{{--                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                        @error('password')--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                                <strong>{{ $message }}</strong>--}}
{{--                            </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row mb-3">--}}
{{--                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>--}}

{{--                    <div class="col-md-6">--}}
{{--                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row mb-0">--}}
{{--                    <div class="col-md-6 offset-md-4">--}}
{{--                        <button type="submit" class="btn btn-primary">--}}
{{--                            {{ __('Register') }}--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="text-slate-600 p-3">
                    <button type="submit"
                            class="w-full py-3 px-4 font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 ">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
