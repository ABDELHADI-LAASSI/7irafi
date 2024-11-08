<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="header" id="header">
    <div class="container">
        <img src="{{ asset('images/hirfa logo.png') }}" alt="logo" class="logo">
        <ul class="main-nav">
            <li><a href="{{ route('main') }}">الرئيسية</a></li>
            <li><a href="{{ route('hirafiyine') }}">الحرفيين</a></li>
            <li><a href="{{ route('dashboard') }}">فضائي الخاص</a></li>
        </ul>

        @guest
            <ul style="display: flex; align-items: center; justify-content: center; gap: 20px">
                <li><a href="{{ route('login') }}" class="login">تسجيل الدخول</a></li>
                <li><a href="{{ route('register') }}" class="register">إنشاء حساب</a></li>
            </ul>
        @endguest

        @auth
            <ul style="display: flex; align-items: center; justify-content: center; gap: 20px">
                <li>
                    @if (Auth::user()->infos && Auth::user()->infos->image)
                        <img src="{{ asset('storage/' . Auth::user()->infos->image) }}" alt="profile image"
                            id="profile_image" class="profile_image" onclick="toggleMenu()">
                    @else
                        <img src="{{ asset('images/profile_image.png') }}" alt="profile image" id="profile_image"
                            class="profile_image" onclick="toggleMenu()">
                    @endif
                </li>
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            @if (Auth::user()->infos && Auth::user()->infos->image)
                                <img src="{{ asset('storage/' . Auth::user()->infos->image) }}" alt="profile image"
                                    class="profile_image">
                            @else
                                <img src="{{ asset('images/profile_image.png') }}" alt="profile image"
                                    class="profile_image">
                            @endif
                            <div >
                                <p class="me-3">{{ Auth::user()->name }}</p>
                                <p class="me-3 text-black-50">{{ Auth::user()->email }}</p>
                            </div>



                        </div>
                        <hr>
                        <ul class="sub-menu-link">
                            <li class="d-flex">
                                <i class="fa-solid fa-user d-flex align-items-center"></i>
                                <a href="{{ route('profile') }}" class="btn btn-link  text-decoration-none d-flex align-items-center">
                                    ملفى الشخصى
                                </a>
                            </li>
                            <li class="d-flex">
                                <i class="fa-solid fa-bookmark d-flex align-items-center"></i>
                                <a href="{{ route('savedPosts') }}" class="btn btn-link  text-decoration-none d-flex align-items-center">
                                    المنشورات المحفوظة
                                </a>
                            </li>
                            <li class="d-flex">
                                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                                    @csrf
                                    <i class="fa-solid fa-right-from-bracket d-flex align-items-center"></i>
                                    <button type="submit" class="btn btn-link text-decoration-none d-flex align-items-center">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>


                    </div>
                </div>
            </ul>
        @endauth
    </div>
</div>





<style>
    * {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    :root {
        --main-color: #2196f3;
        --main-color-alt: #1787e0;
        --main-transition: 0.3s;
        --main-padding-top: 100px;
        --main-padding-bottom: 100px;
        --section-background: #ececec;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: "Cairo", sans-serif;
    }

    a {
        text-decoration: none;
    }

    ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .container {
        padding-left: 15px;
        padding-right: 15px;
        margin-left: auto;
        margin-right: auto;
    }


    .containerNav {
        padding-left: 15px;
        padding-right: 15px;
        width: 100%;
    }



    /* Small */
    @media (min-width: 768px) {
        .containerNav {
            width: 750px;
        }
    }

    /* Medium */
    @media (min-width: 992px) {
        .containerNav {
            width: 970px;
        }
    }

    /* Large */
    @media (min-width: 1200px) {
        .containerNav {
            width: 1300px;
        }
    }

    .header {
        box-shadow: 0px 0px 15px whitesmoke;
        position: relative;
        direction: rtl;
    }


    @media (max-width: 768px) {
        .header .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
    }



    .header .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }


    .header .container .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        height: 59.55px;
        font-weight: bold;
        color: var(--main-color);
    }

    .header .main-nav {
        display: flex;
        align-items: center;


        .header .containerNav {
            width: 100%;
            display: flex;
            justify-content: space-between;

        }

        .header .containerNav .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            height: 59.55px;
            font-weight: bold;
            color: var(--main-color);
        }



    }

    .header .main-nav li a {
        position: relative;
        color: black;
        font-size: 17px;
        transition: var(--main-transition);
        display: flex;
        align-items: center;
        height: 59.55px;
        padding: 0px 19px;
        overflow: hidden;
    }

    .header .main-nav li a:hover {
        color: var(--main-color);
        background-color: var(--section-background);
    }

    .header .main-nav>li>a::before {
        content: "";
        height: 4px;
        background-color: var(--main-color);
        top: 0;
        position: absolute;
        width: 100%;
        left: -100%;
        transition: var(--main-transition);
    }

    .header .main-nav>li>a:hover::before {
        left: 0;
    }

    .login {
        display: flex;
        padding: 10px 20px;
        background-color: var(--main-color);
        color: white;
        border-radius: 5px;
        transition: var(--main-transition);
        border: none;
        cursor: pointer;
        font-size: 15px;
    }

    .register {
        display: flex;
        padding: 10px 20px;
        color: black;
        border-radius: 5px;
        transition: var(--main-transition);
        border: none;
        cursor: pointer;
        font-size: 15px;
    }

    /* From Uiverse.io by akshat-patel28 */


    .button {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0e0d0d;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .icon {
        font-size: 20px;
    }

    .profile_image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    .sub-menu-wrap {
        position: absolute;
        top: 80%;
        left: 50px;
        width: 250px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.5s ease;
        z-index: 1;
    }

    .sub-menu-wrap.open-menu {
        max-height: 400px;
        /* or any max height suitable for your content */
    }

    .sub-menu {
        background: #f7f6f6;
        padding: 20px 12px;
        margin: 10px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .sub-menu hr {
        border: 0;
        height: 1px;
        width: 100%;
        background: #ccc;
        margin: 15px 0 10px;
    }

    .sub-menu .user-info p {
        width: 100%;
    }

    .sub-menu .user-info p b {
        color: #0e0d0d;
        margin-left: 10px;
    }

    .sub-menu a {
        display: block;
        text-decoration: none;
        color: #0e0d0d;
        margin: 12px 0;
    }

    .sub-menu a:hover {
        color: var(--main-color);
    }

    .sub-menu .logout {
        color: #e74c3c;
    }

    .sub-menu .logout:hover {
        color: #0e0d0d;
    }



    @media (max-width:767px) {}
</style>
<script>
    function toggleMenu() {
        var subMenu = document.getElementById("subMenu");
        subMenu.classList.toggle("open-menu");
    }
</script>

</html>
