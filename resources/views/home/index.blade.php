@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <?php Barryvdh\Debugbar\Facades\DebugBar::info('hello') ?>
                        <div class="addresses">
                            <div class="addresses_title">Your addresses</div>
                            @forelse(auth()->user()->addresses as $address)
                                <div class="address">
                                    <div class="address_name">{{ $address->address }}</div>
                                    <div class="address_content">
                                        <div class="counters_title">Counters for this address</div>
                                        <div class="counters">
                                            @forelse($address->counters as $counter)
                                                <div class="counter">
                                                    <div class="counter_field">
                                                    <span
                                                        class="counter_field_label">Регистрационный номер типа СИ:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->registration_type_number }}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">Модификация СИ:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->modification_name}}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">Заводской номер СИ:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->factory_number}}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">Год выпуска СИ:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->release_year ?: 'Не указан' }}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">Дата поверки СИ:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->verification_date}}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">Поверка действительна до:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->valid_until}}</span>
                                                    </div>
                                                    <div class="counter_field"><span class="counter_field_label">СИ пригодно:</span>
                                                        <span
                                                            class="counter_field_value">{{ $counter->is_valid ? 'Да' : 'Нет'}}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="no_counters">No counters</div>
                                            @endforelse
                                        </div>
                                        <div class="add_counter">
                                            <input type="hidden" name="address_id" value="{{ $address->id }}">
                                            @include('auth.partials.input', ['label' => 'Регистрационный номер типа СИ', 'name' => 'register_type', 'type' => 'text', 'value' => old('register_type'), 'isRequired' => false])
                                            @include('auth.partials.input', ['label' => 'Заводской номер СИ', 'name' => 'factory_number', 'type' => 'text', 'value' => old('factory_number'), 'isRequired' => false])
                                            <button type="button"
                                                    class="w-full border-blue-700 py-2 px-4 font-medium text-white bg-blue-600 rounded-lg flex items-center justify-center hover:bg-blue-700">
                                                <i class="animate-spin fck-spinner inline-block hidden"></i>Add counter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No addresses :(
                            @endforelse
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
