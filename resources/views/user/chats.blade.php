@extends('OurLayouts.master')

@section('title', 'Conversations')

@section('content')
<div class="container">
    <div class="conversation-list">
        @forelse ($conversations as $conversation)
            <div class="conversation-item">
                <a href="{{ route('user.chat', ['id' => $conversation->sender_id == Auth::id() ? $conversation->receiver_id : $conversation->sender_id]) }}">
                    <h4>{{ $conversation->sender_id == Auth::id() ? $conversation->receiver->name : $conversation->sender->name }}</h4>
                    <p>{{ $conversation->message }}</p>
                    <small>{{ $conversation->created_at->diffForHumans() }}</small>
                </a>
            </div>
        @empty
            <p>No conversations found.</p>
        @endforelse
    </div>

</div>
@endsection
<style>
    .conversation-list {
        display: flex;
        flex-direction: column;

        direction: rtl;
        margin-top: 50px;
    }

    .conversation-item {
        background-color: #f0f2f5;
        border: none;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .conversation-item:hover {
        background-color: #e4e6eb;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .conversation-item a {
        text-decoration: none;
        display: flex;
        flex-direction: column ;
        gap: 10px;
    }

    .conversation-item h4 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #050505;
    }

    .conversation-item p {
        margin: 0;
        font-size: 14px;
        color: #606770;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .conversation-item small {
        font-size: 12px;
        color: #606770;
    }

    .conversation-item img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #1877f2;
    }
</style>

