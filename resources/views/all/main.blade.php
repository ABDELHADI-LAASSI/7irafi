@extends('OurLayouts.master')

@section('title', 'All')

@section('content')
    <div class="container">

        <h1>All Posts</h1>
        
        <div>
            
            @foreach ($posts as $post)
            
            <div>
                <div class="post_head">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->description }}</p>
                </div>
                <div class="post_image">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}">
            </div>
            <div class="post_footer">
                <button>like</button>
                <button>comments</button>
                <button>save</button>
                <button>interested</button>
            </div>
        </div>
        @endforeach
    
        </div>
        <div>
            {{ $posts->links() }}
        </div>

    </div>
@endsection
