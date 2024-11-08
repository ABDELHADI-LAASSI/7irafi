@extends('OurLayouts.master')

@section('title', 'Saved Posts')

@section('content')

<div class="container">
    <div class="profile">
        <h2>Saved Posts</h2>
    </div>
    <div class="posts">
        @foreach ($posts as $post)
            <div class="post">
                <img src="{{ $post->image }}" alt="Post Image" />
                <div class="post_body">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->description }}</p>
                </div>
                <div class="post_footer">
                    <div class="post_infos">
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

<style>
 

    .profile h2 {
        font-size: 28px;
        text-align: center;
        margin-bottom: 20px;
        color: #2196f3;
    }

    /* Posts Grid */
    .posts {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    /* Post Card */
    .post {
        background: #f8f9fa;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .post:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .post img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-bottom: 2px solid #2196f3;
    }

    .post_body {
        padding: 15px;
    }

    .post_body h3 {
        font-size: 22px;
        color: #333;
        margin-bottom: 10px;
    }

    .post_body p {
        font-size: 16px;
        color: #555;
    }

    .post_footer {
        padding: 15px;
        background: #f1f1f1;
        border-top: 1px solid #ddd;
        text-align: right;
    }

    .post_infos p {
        font-size: 14px;
        color: #888;
    }

    /* Responsive Design */
    @media (min-width: 600px) {
        .posts {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (min-width: 900px) {
        .posts {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }

    @media (max-width: 768px) {
        .post_body h3 {
            font-size: 18px;
        }

        .post_body p {
            font-size: 14px;
        }
    }
</style>
