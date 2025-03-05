<x-layout>
    <x-slot name="header">
        <h1>{{ $post->title }}</h1>
        <x-auth/>
        <p><a href="{{ route('posts.index') }}">&laquo; All Posts</a></p>
        <hr>
    </x-slot>

    {!! $post->content !!}

    <h2>Comments</h2>
    @if ($comments->isEmpty())
        <p><i>Empty</i></p>
    @else
        <ul>
            @foreach ($comments as $comment)
                <li>
                    <code>{{ $comment->created_at }}</code>
                    <p>{{ $comment->content }}</p>
                </li>
            @endforeach
        </ul>
    @endif
</x-layout>
