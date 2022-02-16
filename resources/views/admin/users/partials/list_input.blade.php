<div class="text-slate-600 p-3">
    <div id="roles">
        {{ $label }}:
        @foreach($values ?? [] as $value)
        <div class="li_role" name="{{ $value->id }}">
            <div class="role_info">
                {{ $value->id }} - {{ $value->name }}
                <br>
                {{ $value->description }}
            </div>
            <div class="delete_role"><span class="x_del">x</span></div>
            <input type="hidden" name="{{ $name ?? "roles" }}[]" value="{{ $value->id }}">
        </div>
        @endforeach
    </div>
    <div class="add_role li_role">+</div>

    <div class="popup hidden"><div class="window"></div></div>
</div>
