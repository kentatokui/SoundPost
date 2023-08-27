<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/member_res.css">
    <title>Document</title>
</head>
<body>
    <div class = "login_form">
        <form action="{{ route('home.change_pass') }}">
            @csrf
            <div>
                <p>メールアドレス</p>
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
                <p>ユーザーID</p>
                @if(isset($_SESSION['uid_err']))
                <p>{{ $_SESSION['uid_err'] }}</p>
                @endif
                <input type="text" name = "uid" placeholder="userId @xxxxxx" autocomplete=”off”>
            </div>
            <div>
                <p>新規パスワード</p>
                @if(isset($_SESSION['new_pass_err']))
                <p>{{ $_SESSION['new_pass_err'] }}</p>
                @endif
                <input type="password" name = "new_pass" placeholder="password" autocomplete=”off”>
            </div>
            <div>
                <p>確認用パスワード</p>
                @if(isset($_SESSION['pass_conf_err']))
                <p>{{ $_SESSION['pass_conf_err'] }}</p>
                @endif
                <input type="password" name = "new_pass_conf" placeholder="Confirmation password" autocomplete=”off”>
            </div>
            <div class = "login">
                <input type="submit" value = "変更">
            </div>
            
        </form>
    </div>

</body>
</html>
<?php
unset($_SESSION['email_err']);
unset($_SESSION['pass_err']);
unset($_SESSION['e_p_err']);
unset($_SESSION['new_pass_err']);
unset($_SESSION['pass_conf_err']);
?>