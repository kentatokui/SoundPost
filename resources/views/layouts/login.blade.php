<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/login.css">
    <title>Document</title>
</head>
<body>
    <div class = "login_form">
        <form action="{{ route('home.login_process') }}">
            @csrf
            <div>
                @if(isset($_SESSION['email_err']))
                <p>{{ $_SESSION['email_err'] }}</p>
                @endif
                @if(isset($_SESSION['e_p_err']))
                <p>{{ $_SESSION['e_p_err'] }}</p>
                @endif

                @if(isset($_SESSION['input_email']))
                <input type="text" name = "email" value="{{ $_SESSION['input_email'] }}">
                @else
                <input type="text" name = "email" placeholder="sample@sample.com">
                @endif
            </div>
            <div>
                @if(isset($_SESSION['pass_err']))
                <p>{{ $_SESSION['pass_err'] }}</p>
                @endif
                <input type="password" name = "pass" placeholder="password" autocomplete="off">
            </div>
            <div class = "login">
                <button type='submit' id="login">Login</button>
            </div>
        </form>
        </form>
        <a href="{{ route('home.member_res') }}">新規会員登録</a>
        <a href="{{ route('home.change_pw') }}">パスワードを忘れた方はこちら</a>
    </div>
    
</body>
</html>
<?php
unset($_SESSION['email_err']);
unset($_SESSION['input_email']);
unset($_SESSION['pass_err']);
unset($_SESSION['e_p_err']);
?>
