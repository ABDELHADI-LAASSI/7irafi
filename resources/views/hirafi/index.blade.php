<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .chat-container {
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .users-list {
            width: 30%;
            border-right: 1px solid #ccc;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .users-list h4 {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #ccc;
            background-color: #e9ecef;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            transition: background-color 0.3s;
        }

        .user-item:hover {
            background-color: #f1f1f1;
        }

        .chat-area {
            width: 70%;
            display: flex;
            flex-direction: column;
            background-color: #ffffff;
        }

        .user-image {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            height: 4rem;
        }

        .chat-messages {
            direction: rtl;
            flex: 1;
            overflow-y: auto;
            padding: 10px;
            background-color: #f5f5f5;
        }

        .message {
            max-width: fit-content;
            word-wrap: break-word;
            margin: 5px 0;
            padding: 8px 12px;
            border-radius: 12px;
        }

        .message.sent {
            text-align: right;
            align-self: flex-end;
            background-color: #007bff;
            color: white;
        }

        .message.received {
            text-align: left;
            align-self: flex-start;
            background-color: #e9ecef;
            color: black;
        }

        .chat-input {
            padding: 10px;
            border-top: 1px solid #ccc;
            background-color: #e9ecef;
        }

    
    </style>
</head>

<body>
    <div class="chat-container">
        <!-- Users List -->
        <!-- Users List -->
        <div class="users-list">
            <h4>Conversations</h4>
            <ul class="list-group">
                @foreach ($users as $user)
                    <li class="user-item d-flex align-items-center" data-id="{{ $user->id }}" role="button">
                        <!-- Check if user image exists -->
                        <img src="{{ $user->infos->image ?? 'https://via.placeholder.com/50' }}"
                            alt="{{ $user->name }}"
                            style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                        <span>{{ $user->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Chat Area -->
        <div class="chat-area">
            <div class="user-image" style="display: none;">
                <img src="https://via.placeholder.com/50" alt="User Avatar"
                    style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">
                <span id="chat-user-name"> {{ $user->name }} </span>

            </div>
            <div id="chat-box" class="chat-messages" >
                <p class="text-center text-muted">Select a user to see messages</p>
            </div>
            <div class="chat-input"  style="display: none">
                <form id="send-message-form">
                    <input type="hidden" id="receiver-id" value="">
                    <div class="input-group">
                        <input type="text" id="message-input" class="form-control" placeholder="Type a message">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.user-item').click(function() {
                const userId = $(this).data('id');
                $('#receiver-id').val(userId);

                // Set user image in the chat header
                const userImage = $(this).find('img').attr('src');
                $('.user-image img').attr('src', userImage);

                // Set user name in the chat header
                const userName = $(this).find('span').text(); // Get the user's name from the clicked item
                $('#chat-user-name').text(userName); // Update the header with the dynamic name

                // Show chat area
                $('.chat-input, .user-image').show();

                // Load messages
                $.get(`/hirafi/messages/${userId}`, function(response) {
                    $('#chat-box').html(response.html);
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                });
            });

            // Handle message sending
            $('#send-message-form').submit(function(e) {
                e.preventDefault();

                const message = $('#message-input').val().trim();
                if (!message) return;

                const data = {
                    receiver_id: $('#receiver-id').val(),
                    message,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.post('/hirafi/send-message', data)
                    .done(function() {
                        const userId = $('#receiver-id').val();
                        $.get(`/hirafi/messages/${userId}`, function(response) {
                            $('#chat-box').html(response.html);
                            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                            $('#message-input').val('');
                        });
                    })
                    .fail(function() {
                        alert('Failed to send message. Please try again.');
                    });
            });
        });
    </script>
</body>

</html>
