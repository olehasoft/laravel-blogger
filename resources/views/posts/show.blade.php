<x-layout>
    <x-slot name="header">
        <h1>{{ $post->title }}</h1>
        <x-auth/>
        <p><a href="{{ route('posts.index') }}">&laquo; All Posts</a></p>
        <hr>
    </x-slot>

    {!! $post->content !!}

    <h2>Comments</h2>

    @auth
        @if($errors->any())
            <div style="color:red">
                <h4>Errors:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.comment', $post) }}" method="POST">
            @csrf

            <label style="display:block">
                Create Comment<br>
                <textarea name="content" placeholder="Comment" cols="50" rows="3" maxlength="1000" required>{{ old('content') }}</textarea>
            </label>

            <button type="submit">Save</button>
        </form>
    @endauth

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
