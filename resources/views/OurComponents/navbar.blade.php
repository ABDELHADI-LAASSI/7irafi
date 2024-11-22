<nav class="navbar navbar-expand-lg navbar-light bg-light" style="direction: rtl;">
    <a class="navbar-brand" href="{{ route('main') }}">حرفة يدي</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('main') }}"> الرئيسية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('hirafiyine') }}">الحرفييين</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}">بروفايلي</a>
            </li>
            <li>
                <a class="nav-link" href="{{ route('savedPosts') }}">المنشورات المحفوظة</a>
            </li>
            @if(Auth::check() && Auth::user()->role == 'hirafi')
                <li>
                    <a class="nav-link" href="{{ route('hirafi.index') }}">my dashboard</a>
                </li>
            @elseif(Auth::check() && Auth::user()->role == 'user')
                <li>
                    <a class="nav-link" href="{{ route('user.index') }}">my dashboard</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
