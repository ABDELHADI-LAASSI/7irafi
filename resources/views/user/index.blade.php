<h1>
    user
</h1>

<form action="{{ route('logout') }}" method="post">
    @csrf
    <button>
        log out
    </button>
</form>