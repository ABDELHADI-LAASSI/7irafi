
        <div class="header" id="header">
            <div class="container">
                <a href="#" class="logo">Elzero</a>
                <ul class="main-nav">
                    <li><a href="{{route('main')}}">الرئيسية</a></li>
                    <li><a href="{{route('hirafiyine')}}">الحرفيين</a></li>
                    <li><a href="{{route('dashboard')}}"> فضائي الخاص </a></li>
                </ul>
                @guest
                    <ul style="display: flex; align-items: center; justify-content: center ; gap: 20px">
                        <li><a href="{{ route('login') }}" class="login">تسجيل الدخول</a></li>
                        <li><a href="{{ route('register') }}" class="register">إنشاء حساب</a></li>
                    </ul>
                @endguest
                @auth
                    <ul style="display: flex; align-items: center; justify-content: center ; gap: 20px">
                        <li><a href="{{ route('profile') }}"> <button class="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                        stroke-width="0" fill="currentColor" stroke="currentColor" class="icon">
                                        <path
                                            d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z">
                                        </path>
                                    </svg>
                                </button> <i class="fi fi-rs-user"></i> </a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="logout"
                                    style="background: rgb(228, 52, 52); border: none; color: white; cursor: pointer; padding: 10px;border-radius: 7px;">
                                    تسجيل الخروج
                                </button>
                            </form>
                        </li>
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

            /* Small */
            @media (min-width: 768px) {
                .container {
                    width: 750px;
                }
            }

            /* Medium */
            @media (min-width: 992px) {
                .container {
                    width: 970px;
                }
            }

            /* Large */
            @media (min-width: 1200px) {
                .container {
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


            @media (max-width:767px) {}
        </style>



    </html>
