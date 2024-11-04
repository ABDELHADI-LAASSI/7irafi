@extends('OurLayouts.master')

@section('title', 'All')

@section('content')
    <div class="container">
        <div class="acceuil_content">

            <div class="hirafyin">
                <h1 >الحرفيين</h1>

                <div class="hirafis">
                    @foreach ($hirafyiin as $hirafi)
                        <div class="hirafi">
                            <a href="">
                                    <img src="{{ $hirafi->infos->image }}" alt="Hirafi Image">
                                    <h6>{{ $hirafi->name }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="posts">

                @foreach ($posts as $post)

                    <div class="post">

                        <div class="post_head">
                            <div class="post_user">
                                <div>
                                    <h2>{{ $post->user->name }}</h2>
                                    <p> {{$post->posted_at}} </p>
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
                            {{-- <img src="{{ $post->image }}" alt="{{ $post->title }}"> --}}
                            <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" alt="">
                        </div>

                        <div class="post_footer">
                            <div class="post_infos">
                                <div class="likes">
                                    <p>{{ $post->likes->count() }} إعجاب</p>

                                    @auth
                                        @if ($post->liked == false)
                                            <form action="{{ route('like.post', ['post' => $post->id, 'user' => auth()->user()->id]) }}" method="POST">
                                                @csrf
                                                <button>اعجاب</button>
                                            </form>
                                        @else
                                            <form action="{{ route('like.delete', ['post' => $post->id, 'user' => auth()->user()->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button>ازالة الاعجاب</button>
                                            </form>
                                        @endif

                                    @endauth

                                </div>
                                <p>{{ $post->comments->count() }} تعليق</p>
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
                                                <h2>{{ $comment->user->name }}</h2>
                                                @if ($comment->user->infos && $comment->user->infos->image)
                                                <img src="{{ $comment->user->infos->image }}" alt="User Image">
                                                @endif
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
                                    <button>اضافة تعليق</button>
                                    <input name="content" type="text">
                                </form>
                            </div>


                        </div>

                    </div>

                @endforeach

            </div>

            <div class="side_links">
                <ul>
                    <li>
                        <a href="">المنشورات المحفوظة</a>
                    </li>
                    <li>
                        <a href="">الاعجابات</a>
                    </li>
                </ul>
            </div>

        </div>
        <div>
            {{ $posts->links() }}
        </div>

    </div>


    <style>
        p {
            margin: 0
        }
        .acceuil_content {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: 1fr 740px 1fr;
            column-gap: 2rem

        }

        .hirafyin , .side_links {
            background: #f5f5f5;
            padding: 1rem;
            border-radius: 10px;
            box-sizing: border-box;
            direction: rtl
        }

        .hirafyin h1 {
            text-align: center;
            margin: 0;
            font-size: 20px;
            margin-bottom: 2rem;
        }

        .hirafyin .hirafis{
            display: grid;
            row-gap: 2rem
        }

        .hirafyin .hirafis .hirafi {
            background-color: white;
            padding: 10px;
            text-align: center;
        }

        .hirafyin .hirafis .hirafi a {
            text-decoration: none;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            row-gap: 1rem

        }

        .hirafyin .hirafis .hirafi img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .hirafyin .hirafis .hirafi h6 {
            text-align: center;
            margin: 0
        }

        .side_links ul {
            display: grid;
            row-gap: 2rem
        }

        .side_links ul li {
            display: flex;
            column-gap: 1rem;
            background-color: white;
            padding: 10px
        }

        .side_links ul li a {
            text-decoration: none;
            color: black
        }
        .posts {
            display: flex;
            flex-direction: column;
            row-gap: 2rem;
            direction: rtl;
            padding: 10px;
            background: #f5f5f5;
            align-items: center
        }

        .posts .post {
            max-width: 700px;
            display: grid;
            row-gap: 1rem;
            padding: 1rem;
            background-color: white;
        }

        .posts .post .post_head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .posts .post .post_user {
            display: flex;
            align-items: center;
            column-gap: 1rem;
            flex-direction: row-reverse;
            justify-content: start;
        }

        .posts .post .post_user img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .posts .post .post_user h2 {
            margin: 0;
            font-size: 18px;
        }

        .posts .post .post_user p {
            margin: 0;
            font-size: 10px;
            font-weight: bold;
        }

        .posts .post .post_body p {
            margin-bottom: 1rem;
        }

        .posts .post .post_body img {
            width: 100%;
        }

        .posts .post .post_footer .likes {
            display: flex;
            flex-direction: row-reverse;
            column-gap: 1rem;
        }

        .posts .post .post_footer .post_infos {
            display: flex;
            justify-content: space-between;
        }

        .posts .post .post_footer .post_buttons {
            display: grid;
            grid-template-columns: 1fr;
            margin-top: 1rem

        }

        .posts .post .post_footer .post_buttons button {
            width: 100%;
        }

        .posts .post .post_footer .comments {
            display: grid;
            row-gap: 1rem;
            margin-top: 2rem;
            padding: 10px;
            border-radius: 5px;
            background-color: #f5f5f5;
        }

        .posts .post .post_footer .comments .comment {
            display: grid;
            row-gap: .5rem;
        }

        .posts .post .post_footer .comments .comment .comment_head {
            display: flex;
            align-items: center;
            column-gap: 5px;
            flex-direction: row-reverse;
            justify-content: start;
        }
        .posts .post .post_footer .comments .comment .comment_head h2 {
            margin: 0;
            font-size: 14px;
        }
        .posts .post .post_footer .comments .comment .comment_head img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .posts .post .post_footer .comments .comment .comment_body {
            background: white;
            display: flex;
            padding: 7px
        }

        .posts .post .post_footer .comments .comment .comment_body p {
            margin: 0;
        }

        .comment_form {
            display: flex;
            column-gap: 1rem;
        }
        .comment_form button {
            padding: .2rem 1rem;
        }

        .comment_form input {
            flex-grow: 1;
        }

        .comments_list {
            max-height: 250px;
            overflow-y: scroll;
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
