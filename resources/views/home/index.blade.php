@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(!auth()->user()->hasEsPlusToken())
                            @include('home.partials.auth_esplus')
                        @else
                            {{ auth()->user()->esPlusToken->refresh_token }}
                        @endif

                        <?php Barryvdh\Debugbar\Facades\DebugBar::info(auth()->user()->hasEsPlusToken()) ?>
                        @include('home.partials.addresses_list')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
