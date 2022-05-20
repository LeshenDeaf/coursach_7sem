<div class="addresses">
    <div class="addresses_title">Your addresses</div>
    @forelse(auth()->user()->addresses as $address)
        <div class="address">
            <div class="address_name">{{ $address->address }}</div>
            <div class="address_content">
                <div class="counters_title">Counters for this address</div>
                @include('home.partials.counters', ['counters' => $address->counters, 'address_id' => $address->id])
            </div>
        </div>
    @empty
        No addresses :(
    @endforelse
    <div class="popup hidden"><div class="window"></div></div>
</div>
