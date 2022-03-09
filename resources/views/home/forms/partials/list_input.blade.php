<div class="text-slate-600 p-3">
    <div id="fields">
        {{ $label }}:
        @foreach($fields ?? [] as $field)
        <div class="li_field" name="{{ $field->id }}">
            <div class="field_info">
                {{ $field->label }} <span class="text-gray-600">({{ \App\Models\Field::getTypeLabel($field->type) }})</span>
            </div>
            @if ($canDelete ?? true)
                <div class="delete_field"><span class="x_del">x</span></div>
            @endif
            <input type="hidden" name="fields[]" value="{{ $field->id }}">
        </div>
        @endforeach
    </div>
    <div class="add_field li_field">+</div>

    <div class="popup hidden"><div class="window"></div></div>
</div>
