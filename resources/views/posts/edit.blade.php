<x-layout>
    <x-slot name="header">
        <h1>Edit Post</h1>
        <x-auth/>
        <p><a href="{{ route('posts.index') }}">&laquo; All Posts</a></p>
        <hr>
    </x-slot>

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

    <form action="{{ route('posts.update', $post) }}" method="POST">
        @csrf @method('PUT')

        <label style="display:block">
            Title<br>
            <input type="text" name="title" placeholder="Title" size="50" maxlength="250" value="{{ old('title', $post->title) }}" required>
        </label>

        <br>
        <label style="display:block">
            Content<br>
            <textarea name="content" placeholder="Content" cols="50" rows="10" maxlength="16380" required>{{ old('content', $post->content) }}</textarea>
        </label>

        <br>
        <label>
            Category
            <select name="category_id" required style="display:inline">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </label>

        <br><br>
        <button type="submit">Save</button>
    </form>
</x-layout>
