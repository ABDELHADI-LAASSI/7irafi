<h1>
    admin
</h1>


<form action="{{ route('logout') }}" method="post">
    @csrf
    <button>
        log out
    </button>
</form>