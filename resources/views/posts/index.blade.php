<x-layout>
    <x-slot name="header">
        <h1>Posts</h1>
        <x-auth/>
        <hr>
    </x-slot>

    @auth
        <p><a href="{{ route('posts.create') }}">Create Post &raquo;</a></p>
    @endauth

    @if ($posts->isEmpty())
        <p><i>Empty</i></p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->name }}</td>
                        <td>
                            <a href="{{ route('posts.show', $post) }}">Show</a>

                            @auth
                                <a href="{{ route('posts.edit', $post) }}">Edit</a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                    onsubmit="return confirm('Do you really want to delete post {{ $post->id }}?');"
                                    style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <br>
    {{ $posts->links() }}
</x-layout>
