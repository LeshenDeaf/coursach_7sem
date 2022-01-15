<div class="alert">
    @if (session('success'))
        @include('partials.alerts.success', ['message' => session('success')])
    @elseif (session('error'))
        @include('partials.alerts.error', ['message' => session('error')])
    @endif
</div>

