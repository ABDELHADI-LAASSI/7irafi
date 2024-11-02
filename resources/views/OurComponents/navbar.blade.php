@extends('OurLayouts.master')
@section('navbar')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/elzero.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Aniss</title>
</head>
<body>
    <div class="header" id="header">
        <div class="container">
            <a href="#" class="logo">Elzero</a>
            <ul class="main-nav">
                <li><a href="#الرئيسية">الرئيسية</a></li>
                <li><a href="#الحرف">الحرف</a></li>
            </ul>
            @guest
            <ul style="display: flex; align-items: center; justify-content: center ; gap: 20px">
                <li><a href="{{ route('login') }}" class="login">تسجيل الدخول</a></li>
                <li><a href="{{ route('register') }}" class="register">إنشاء حساب</a></li>
            </ul>
            @endguest
            @auth
            <ul style="display: flex; align-items: center; justify-content: center ; gap: 20px">
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout" style="background: none; border: none; color: inherit; cursor: pointer;">
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
      width: 1170px;
    }
  }
.header{
    box-shadow: 0px 0px 15px whitesmoke;
    position: relative;
    direction: rtl;
}

.header .container{
     display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.header .container .logo{
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    height: 59.55px;
    font-weight: bold;
    color: var(--main-color);
}

.header .main-nav{
    display: flex;
    align-items: center;

}

.header .main-nav li a{
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
.header .main-nav li a:hover{
    color: var(--main-color);
    background-color: var(--section-background);
}
.header .main-nav > li > a::before {
    content: "";
    height: 4px;
    background-color: var(--main-color);
    top: 0;
    position: absolute;
    width: 100%;
    left: -100%;
    transition: var(--main-transition);
}
.header .main-nav >li> a:hover::before{
    left: 0;
}
.login{
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
.register{
    display: flex;
    padding: 10px 20px;
    color: black;
    border-radius: 5px;
    transition: var(--main-transition);
    border: none;
    cursor: pointer;
    font-size: 15px;
}
@media (max-width:767px){

}
    </style>


</body>
</html>

@endsection
