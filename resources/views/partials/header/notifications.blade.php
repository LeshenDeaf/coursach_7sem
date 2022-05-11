<div class="wrap notifications">
    <div class="wrap_header notifications_head">
        @if($notifications->isEmpty())
            No notifications :)
        @else
            <span class="notifications_count">{{ count($notifications) }}</span> новых уведомлений
        @endif
    </div>
    <div class="wrap_body notifications_body hidden">
        @forelse($notifications as $notification)
            <div class="notification">
                <div class="text-slate-700">
                    {{ date('d.m.Y H:i:s', strtotime($notification->created_at)) }}
                </div>
                <div>
                    {{ $notification->data['_message'] }}
                </div>
                <button class="mark-as-read block ml-auto mr-0 bg-transparent text-blue-400 hover:text-blue-700 focus:outline-0 active:outline-0"
                        href="#"
                        data-id="{{ $notification->id }}">
                    Mark as read
                </button>
            </div>
            @if($loop->last)
                <div
                    class="sticky bottom-0.5 w-fit rounded-lg border mx-auto bg-white px-3 py-1 hover:text-blue-600 hover:border-blue-300">
                    <a class="block" href="#" id="mark-all">
                        Mark all as read
                    </a>
                </div>

            @endif
        @empty
            There are no new notifications
        @endforelse
    </div>
</div>
