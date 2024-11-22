@extends('OurLayouts.master')
@section('title', 'Conversations')

@section('content')
<div class="container">
    <div class="messages">
        @foreach ($messages as $message)
            <div class="{{ $message->sender_id == Auth::id() ? 'message-sent' : 'message-received' }}">
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->format('H:i') }}</small>
            </div>
        @endforeach
    </div>
    <form method="POST" action="{{ route('user.sendMessage', $otherUser->id) }}">
        @csrf
        <textarea name="message" placeholder="Type your message..." required></textarea>
        <button type="submit">إرسال</button>
    </form>
</div>

<style>
    .messages {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 20px;
        background-color: #f0f2f5;
        height: 500px;
        overflow-y: auto;
        border-radius: 10px;
    }

    .message-sent {
        align-self: flex-end;
        max-width: 60%;
        background-color: #0084ff;
        color: white;
        padding: 10px;
        border-radius: 15px 15px 0 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
    }

    .message-received {
        align-self: flex-start;
        max-width: 60%;
        background-color: #e4e6eb;
        color: #050505;
        padding: 10px;
        border-radius: 15px 15px 15px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
    }

    .message-sent small,
    .message-received small {
        display: block;
        font-size: 10px;
        color: rgba(255, 255, 255, 0.7);
        margin-top: 5px;
        text-align: right;
    }

    .message-received small {
        color: #606770;
    }

    form {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        background-color: #ffffff;
        border-top: 1px solid #ddd;
        border-radius: 0 0 10px 10px;
    }

    form textarea {
        flex: 1;
        resize: none;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.3s;
    }

    form textarea:focus {
        border-color: #0084ff;
    }

    form button {
        background-color: #0084ff;
        color: white;
        padding: 20px;
        border: none;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
        border-radius: 8px;
    }

    form button:hover {
        background-color: #005bb5;
    }

    /* Scrollbar Styling */
    .messages::-webkit-scrollbar {
        width: 8px;
    }

    .messages::-webkit-scrollbar-thumb {
        background-color: #ccc;
        border-radius: 4px;
    }

    .messages::-webkit-scrollbar-thumb:hover {
        background-color: #999;
    }
</style>

@endsection
