@extends('OurLayouts.userInfoMaster')

@section('title', 'userInfo')

@section('content')
    <div class="userChat">
        <div class="conversation">
            <div class="conversation_header">
                <img src="{{ asset('storage/' . $user->infos->image) }}" />
                <h2>{{ $user->name }}</h2>
            </div>
            <div class="conversation_body">
                @foreach ($chat as $message)
                    @if ($message->sender_id == Auth::user()->id)
                        <div class="right">
                            <p>{{ $message->message }}</p>
                            <small>{{$message->timestamp}}</small>
                        </div>
                    @else
                        <div class="left">
                            <p>{{ $message->message }}</p>
                            <small>{{$message->timestamp}}</small>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="conversation_footer">
                <form action="{{ route('chat.store', ['sender' => Auth::user()->id, 'recived' => $user->id]) }}" method="POST">
                    @csrf
                    <input type="text" name="message" placeholder="Type a message" />
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    <style>
        .userChat {
            padding: 2rem;
            width: calc(100% - 280px);
            direction: rtl;
        }

        .conversation {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .conversation_header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 1rem;
            background-color: white;
            border-radius: 8px;
            column-gap: 1rem;
        }

        .conversation_header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .conversation_header h2 {
            font-size: 20px;
        }

        .conversation_body {
            display: flex;
            flex-direction: column;
            row-gap: 1rem;
            padding: 1rem;
            background-color: white;
            height: 600px;
            overflow-y: scroll;
            border-radius: 8px;
        }

        .conversation_body .right,
        .conversation_body .left {
            max-width: 70%;
            padding: 1rem;
            border-radius: 12px;
            position: relative;
        }

        .conversation_body .right {
            align-self: flex-start;
            background-color: #3498db;
            color: white;
        }

        .conversation_body .right small {
            color: #e9ecef;
        }

        .conversation_body .left {
            align-self: flex-end;
            background-color: #ecf0f1;
            color: black;
        }

        .conversation_body small {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            color: #777;
        }

        .conversation_footer {
            padding: 1rem;
            background-color: white;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .conversation_footer form {
            display: flex;
            align-items: center;
            width: 100%;
            column-gap: 1rem;
        }

        .conversation_footer form input {
            flex-grow: 1;
            padding: 1rem;
            border: none;
            border-radius: 8px;
            background-color: #f5f5f5;
        }

        .conversation_footer form button {
            padding: 1rem 2rem;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
@endsection
