<!DOCTYPE html>
<html lang="en" id = "html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Black+Ops+One&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SoundPost</title>
    <link rel="stylesheet" href="/css/header.css">
    @stack('styles')
</head>
    <div class="skewed"></div>
    <div class = "header">
        <div class = "logo">
            <a href="{{ route('home.index') }}">
                <img src="../images/font.png" alt="ロゴ">
            </a>
        </div>
    </div>
<body>
    <header id="header">

    <nav id="navi">
        <ul class="nav-menu">
        <li><a href="{{ route('home.index') }}">TopPage</a></li>
        <li><a href="{{ route('home.category') }}">Type category</a></li>
        <li><a href="{{ route('home.bland_category') }}">Bland category</a></li>
        <li><a href="{{ route('home.mypage') }}">MyPage</a></li>
        <li><a href="{{ route('home.login') }}">Login</a></li>
        </ul>
    </nav>

    <div class="toggle_btn">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <div id="mask"></div>
    </header>

</body>
</html>

<script>
    $(function () {
    $('.toggle_btn').on('click', function () {
    if ($('#header').hasClass('open')) {
            $('#header').removeClass('open');
    } else {
        $('#header').addClass('open');
    }
    });

    $('#mask').on('click', function () {
    $('#header').removeClass('open');
    });

    $('#navi a').on('click', function () {
    $('#header').removeClass('open');
    });
});
    </script>
    @if (session('result'))
        <script>
            alert( 'ログインしました。' );
        </script>
    @endif

    @if (session('login'))
        <script>
            alert( 'ログインしてください。' );
        </script>
    @endif

    @if (session('logout'))
        <script>
            alert( 'ログアウトしました。' );
        </script>
    @endif

    @if (session('comment'))
        <script>
            alert( 'この機能を利用するにはログインしてください。' );
        </script>
    @endif

    @if (session('withdrawal'))
        <script>
            alert( '退会しました。' );
        </script>
    @endif


