@extends('OurLayouts.master')

@section('title', 'Post')

@section('content')

    <div class="container">
        <div class="post">

            <div class="post_head">
                <div class="post_user">
                    <div class="d-flex align-items-center" >
                        @if ($post->user->infos && $post->user->infos->image)
                            <img src="{{ asset('storage/' . $post->user->infos->image )}}" alt="User Image">
                        @else
                            <img src={{asset('images/profile_image.png')}} alt="User Image">
                        @endif
                        <h2 class="ms-2">{{ $post->user->name }}</h2>

                    </div>
                    @if ($post->user->infos && $post->user->infos->image)
                        <img src="{{ $post->user->infos->image }}" alt="User Image">
                    @endif
                </div>
                <div class="post_action">
                    @auth
                        @if (!$post->savedByUsers->contains('id', auth()->id()))
                            <form action="{{ route('save.post', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                <button>حفظ</button>
                            </form>
                        @else
                            <form action="{{ route('save.delete', ['post' => $post->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button>إزالة من المحفوظات</button>
                            </form>
                        @endif

                    @endauth
                </div>

            </div>

            <div class="post_body">
                <p>{{ $post->description }}</p>
                {{-- @if ( $post->image)
                 <img src="{{ $post->image }}" alt="{{ $post->title }}">
                 @else --}}
                  <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg"
                    alt="">



            </div>

            <div class="post_footer">
                <div class="post_infos">
                    <div class="likes">
                        <p>{{ $post->likes->count() }} إعجاب</p>

                        @auth
                        @if ($post->liked == false)
                            <form
                                action="{{ route('like.post', ['post' => $post->id, 'user' => auth()->user()->id]) }}"
                                method="POST">
                                @csrf
                                <button class="btn btn-primary">أعجبني</button>
                            </form>
                        @else
                            <form
                                action="{{ route('like.delete', ['post' => $post->id, 'user' => auth()->user()->id]) }}"
                                method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger">ازالة الاعجاب</button>
                            </form>
                        @endif

                    @endauth


                    </div>
                    <p>{{ $post->comments->count() }} تعاليق</p>
                </div>

                <div class="post_buttons">
                    <button class="comments_btn" data-post-id="{{ $post->id }}">اظهار التعليقات</button>
                </div>

                <div class="comments" style="display: none;">

                    <div class="comments_list">
                        @foreach ($post->comments as $comment)
                            <div class="comment">
                                <div>

                                    <a class="comment_head" href="">

                                        <a class="comment_head" href="{{ route('user.show', $comment->user->id) }}">


                                            @if ($comment->user->infos && $comment->user->infos->image)
                                                <img src="{{ $comment->user->infos->image }}" alt="User Image">
                                            @endif
                                            <h2 class="comment_name">{{ $comment->user->name }}</h2>
                                        </a>
                                </div>
                                <div class="comment_body">
                                    <p>{{ $comment->content }}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('comment.store', ['post' => $post->id]) }}" class="comment_form">
                        @csrf
                        <button class="btn btn-info">اضافة تعليق</button>
                        <input name="content" type="text">
                    </form>
                </div>


            </div>

        </div>
    </div>
    <style>
        /* Container styling */
/* Container styling */
.container {
    max-width: 800px;
    margin: auto;
    padding: 20px;
    font-family: Arial, sans-serif;
    color: #333;
}

/* Post styling */
.post {
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-bottom: 20px;
    direction: rtl;
}

.post_head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e6e6e6;
    padding-bottom: 15px;
    flex-wrap: wrap;
}


.post_user h2 {
    font-size: 1.2rem;
    color: #555;
}

.post_user p {
    font-size: 0.9rem;
    color: #888;
}

.post_user img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-left: 10px;
}

.post_action button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 0.9rem;
}

.post_action button:hover {
    background-color: #0056b3;
}

.post_body {
    margin: 20px 0;
}

.post_body img {
    width: 100%;
    height: auto;
    margin-top: 5px;
}

/* Post footer with likes and comments */
.post_footer {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.post_infos {
    display: flex;
    justify-content: space-between;

    font-size: 0.9rem;
    color: #666;
}

.post_infos p {
    margin: 0;
}


.post_buttons button {
    background-color: transparent;
    color: #007bff;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.post_buttons button:hover {
    color: #0056b3;
}

/* Comments section styling */
.comments {
    margin-top: 20px;
    border-top: 1px solid #e6e6e6;
    padding-top: 20px;
}

.comments_list {
    margin-top: 10px;
}

.comment {
    margin-bottom: 10px;
}

.comment_head {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
    text-decoration: none;
}

.comment_head img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.comment_head h2 {
    font-size: 0.9rem;
    color: #555;
    margin: 0;
}

.comment_body {
    background-color: #f5f5f5;
    padding: 10px;
    border-radius: 5px;
    font-size: 0.9rem;
    color: #333;
}

/* Comment form styling */
.comment_form {
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.comment_form input[type="text"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.comment_form button {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 0.9rem;
}

.comment_form button:hover {
    background-color: #218838;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .post_head, .post_infos {
        align-items: flex-start;
    }

    .post_user img {
        width: 40px;
        height: 40px;
        margin-left: 0;
        margin-bottom: 10px;
    }

    .post_user h2 {
        font-size: 1rem;
        margin-left: 10px;
    }

    .post_action button,
    .comment_form button {
        font-size: 0.8rem;
        padding: 6px 12px;
    }

    .comment_head img {
        width: 25px;
        height: 25px;
    }

    .comment_head h2 {
        font-size: 0.85rem;
    }

    .post_body p, .comment_body {
        font-size: 0.85rem;
    }
}

@media (max-width: 767px) {
    .container {
        padding: 10px;
    }

    .post_user h2 {
        font-size: 0.9rem;
        margin-right: 6px;
    }

    .post_action button {
        position: relative;
        padding: 6px 10px;
        top:6px;
    }

    .post_buttons button {
        font-size: 0.8rem;
    }

    .comment_form input[type="text"] {
        padding: 6px;
    }
}


</style>
    <script>
        document.querySelectorAll('.comments_btn').forEach(button => {
            button.addEventListener('click', () => {
                const commentsDiv = button.closest('.post_footer').querySelector('.comments');
                if (commentsDiv.style.display === 'none' || commentsDiv.style.display === '') {
                    commentsDiv.style.display = 'grid';
                    button.innerHTML = 'اخفاء التعليقات';
                } else {
                    commentsDiv.style.display = 'none';
                    button.innerHTML = 'اظهار التعليقات';
                }
            });
        });
    </script>

@endsection
