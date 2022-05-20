<div class="counters" name="{{ $address_id }}">
    @forelse($counters as $counter)
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
@include('home.partials.add_counter')
