@auth
    <p>Hello, {{ auth()->user()->name }}!</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log out</button>
    </form>
@else
    <p><i>Log in to edit the blog.</i></p>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <button type="submit">Log in</button>
    </form>
@endauth
