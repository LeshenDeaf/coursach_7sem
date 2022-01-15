<div class="text-slate-600 p-3">
    <div>
        {{ $label }}:
        @foreach($values as $value)
        <div class="text-slate-800 py-1 px-2 hover:text-blue-900 hover:bg-gray-100 rounded-lg cursor-pointer border-transparent focus:border-transparent focus:ring-0 border-none focus:outline-none">
            {{ $value->id }} - {{ $value->name }}
        </div>
        @endforeach
    </div>
</div>
