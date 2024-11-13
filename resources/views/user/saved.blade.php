@extends('OurLayouts.master')

@section('title', 'Saved Posts')

@section('content')
    <div class="container mt-5">
        <div class="profile">
            <h2 class="text-center mb-4">المنشورات المحفوظة</h2>
        </div>
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="post card shadow-sm h-100">
                        <div class="post_body d-flex align-items-start p-3">
                            <img src="{{ $post->image }}" alt="Post Image" class="img-fluid me-3" style="width: 60px; height: 60px;">
                            <div class="post_description">
                                <p class="text-muted small">{{ \Illuminate\Support\Str::limit($post->description, 80) }}</p>
                            </div>
                        </div>
                        <div class="post_footer bg-light p-2 d-flex justify-content-between align-items-center">
                            <p class="text-secondary small mb-0">{{ $post->user->name }} :منشور بواسطة</p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm">مشاهدة المنشور</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .container {
        max-width: 800px;
        margin: auto;
    }

    .post.card {
        height: 250px; /* Sets a fixed height for all cards */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        transition: box-shadow 0.3s ease;
    }

    .post.card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .post_body {
        display: flex;
        align-items: center;
    }

    .post_description p {
        font-size: 0.9rem;
        color: #666;
        max-height: 60px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .post_footer {
        border-top: 1px solid #f0f0f0;
    }

    .btn-primary {
        font-size: 0.85rem;
        padding: 0.4rem 0.8rem;
    }
</style>
