@extends('layouts.app')

@section('title', __('Forum'))

@section('content')
    <a href="{{ route('home.forum.create') }}"
       class="float-right px-8 py-3 bg-blue-500 text-white rounded-xl shadow-lg hover:bg-blue-700 duration-100 transition-all"
    >
        Create thread
    </a>

    @include("partials.header_text", ['text' => __('Forum')])

    @include("partials.alerts.alert")

    <div class="sticky top-10 float-left w-1/6 wrap rounded-xl border border-gray-200 my-4 py-2">
        <div class="wrap_header text-center text-lg select-none">
            Categories
        </div>

        <div class="wrap_body hidden px-8 pt-2">
            <div class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200">
                <span class="hover:text-blue-400 transition-all">
                    <a href="{{ route('home.forum.index') }}">
                        All
                    </a>
                </span>
            </div>

            @foreach($categories as $category)
                <div class="text-sm font-bold select-none mb-2 border-b py-2 border-b-gray-100 hover:border-b-blue-200">
                    <span class="hover:text-blue-400 transition-all">
                        <a href="{{ route('home.forum.category', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-[650px] mx-auto mb-8">
        <?php
        $startDate = new DateTime(date('Y-m-d H:i:s')); ?>
        @foreach ($threads as $thread)
            <?php
            $timeDiff = $startDate->diff(new DateTime($thread->created_at));
            $timeDiffStr = $timeDiff->days > 0
                ? $timeDiff->days . ' days'
                : ($timeDiff->h > 0
                    ? $timeDiff->h . ' hours'
                    : $timeDiff->i . ' minutes')
            ?>
            <div class="my-8 w-full mx-8">
                <div class="w-full bg-blue-100 px-8 py-4 mb-0 rounded-t-lg">
                    <div class="text-sm font-bold select-none mb-2">
                        <span class="hover:text-blue-400 transition-all">
                            <a href="{{ route('home.forum.category', $thread->category->slug) }}">
                                {{ $thread->category->name }}
                            </a>
                        </span>
                        <span class="ml-6 font-medium">{{ $thread->user->name }}</span>
                        <span class="ml-6 font-medium">{{ $timeDiffStr }} ago</span>
                    </div>
                    <div class="text-2xl">
                        <a href="{{ route('home.forum.show', $thread->slug) }}">
                            {{ $thread->title }}
                        </a>
                    </div>
                </div>
                <div class="py-4 align-middle min-w-full sm:px-6 lg:px-8 shadow overflow-hidden border-b border-gray-200 rounded-lg rounded-t-none ">
                    <div>
                        {{ mb_strimwidth($thread->text, 0, 256, '...') }}
                    </div>
                    <div class="float-right text-sm select-none mt-2">
                        <span class="hover:text-blue-400 transition-all">
                            <a href="{{ route('home.forum.address', $thread->address->id) }}">
                                {{ $thread->address->address }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
