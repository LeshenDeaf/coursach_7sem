@extends('layouts.app')

@section('title', __($thread->title))

@section('content')
{{--    @include("partials.header_text", ['text' => __($thread->title)])--}}

    @include("partials.alerts.alert")

<?php
$startDate = new DateTime(date('Y-m-d H:i:s'));

function getTimeDiff($from, $to): string
{
    $timeDiff = $from->diff(new DateTime($to));
    return $timeDiff->days > 0
        ? $timeDiff->days . ' days'
        : ($timeDiff->h > 0
            ? $timeDiff->h . ' hours'
            : $timeDiff->i . ' minutes');
}

$timeDiffStr = getTimeDiff($startDate, $thread->created_at)
?>
    <div class="-mt-1 mb-8 min-w-full sm:px-6 lg:px-8">
        <div class="w-full bg-blue-200 px-8 py-4 mb-0">
            <div class="w-[650px] mx-auto">
                <div class="text-sm font-bold select-none mb-2">
                    <span class="hover:text-blue-400 transition-all">
                        <a href="{{ route('home.forum.address', $thread->address->id) }}">
                            {{ $thread->address->address }}
                        </a>
                    </span>
                </div>

                <div class="text-sm font-bold select-none mb-2">
                    <span class="hover:text-blue-400 transition-all">
                        <a href="{{ route('home.forum.category', $thread->category->slug) }}">
                            {{ $thread->category->name }}
                        </a>
                    </span>

                    <span class="ml-6 font-medium">{{ $thread->user->name }}</span>
                    <span class="ml-6 font-medium">{{ $timeDiffStr }} ago</span>

                </div>

                <div class="text-2xl">{{ $thread->title }} </div>
            </div>
        </div>

        <div class="shadow overflow-hidden border-b border-gray-200 rounded-lg rounded-t-none py-8">
            <div class="w-[650px] mx-auto">
                <div class="text-black">
                    {!! str_ireplace("\n", "<br>", $thread->text) !!}
                </div>
            </div>
        </div>

        <div class="mt-8 shadow overflow-hidden border-b border-gray-200 rounded-lg py-8">
            <div class="w-[650px] mx-auto">
                <div class="comment_form">
                    <textarea class="comment_input"
                              name="comment"
                              placeholder="Your comment..."
                    ></textarea>
                    <button class="submit_comment"
                            type="button"
                            disabled
                    >Submit</button>
                </div>
                <div class="comments clear-both">
                    @foreach($thread->comments as $comment)
                        <div class="comment border-b border-gray-100 py-1">
                            <div class="text-sm font-bold select-none mb-2">
                                <span class="hover:text-blue-400 transition-all">
                                    {{ $comment->user->name }}
                                </span>
                                <span class="ml-6 font-medium">{{ getTimeDiff($startDate, $comment->created_at) }} ago</span>

                            </div>
                            <div class="comment_text">
                                @if($comment->parent_id)
                                    <span class="comment_reply"
                                          value="{{ $comment->parent_id }}"
                                    >{{ $comment->parent->user->name }}</span>,
                                @endif
                                {{ $comment->body }}
                            </div>
                            <div class="text-sm">
                                <span class="reply">Reply</span>
                            </div>
                            <input type="hidden" name="id" value="{{ $comment->id }}">
                            <div class="reply_form">
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

@endsection
