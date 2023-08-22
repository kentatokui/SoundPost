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
        <form action="{{ route('home.member_comp') }}" method = "post">
            @csrf
            <input type="hidden" name = 'ticket' value = "ticket">
            <div>
                <p>ユーザー名</p>
                    @if(isset($_SESSION['result_name']))
                        <p class ="err"><span style="color:#AF1B3F;font-size: 15px;">{{ $_SESSION['result_name'] }}</span></p>
                    @endif

                    @if(isset($_SESSION['name_ret']))
                        <input type="text" name = "name" value="{{ $_SESSION['name_ret'] }}">
                    @else
                        <input type="text" name = "name" placeholder="10文字以内でご入力ください。">
                    @endif
            </div>
            <div>
                <p>ユーザーID</p>
                    @if(isset($_SESSION['result_uid']))
                        <p class ="err"><span style="color:#AF1B3F;font-size: 15px;">{{ $_SESSION['result_uid'] }}</span></p>
                    @endif

                    @if(isset($_SESSION['uid_ret']))
                        <input type="text" name = "uid" value="{{ $_SESSION['uid_ret'] }}">
                    @else
                        <input type="text" name = "uid" placeholder="10文字以内でご入力ください。">
                    @endif
            </div>
            <div>
                <p>メールアドレス</p>
                    @if(isset($_SESSION['result_email']))
                        <p class ="err"><span style="color:#AF1B3F;font-size: 15px;">{{ $_SESSION['result_email'] }}</span></p>
                    @endif

                    @if(isset($_SESSION['email_ret']))
                        <input type="text" name = "email" value="{{ $_SESSION['email_ret'] }}">
                    @else
                        <input type="text" name = "email" placeholder="sample@sample.com">
                    @endif
            </div>
            <div>
                <p>パスワード</p>
                    @if(isset($_SESSION['result_pass']))
                        <p class ="err"><span style="color:#AF1B3F;font-size: 15px;">{{ $_SESSION['result_pass'] }}</span></p>
                    @endif
                <input type="password" name = "password" placeholder="8文字以上100文字以下でご入力ください。" autocomplete=”off”>
            </div>
            <div>
                <p>確認用パスワード</p>
                    @if(isset($_SESSION['result_pass_conf']))
                        <p class ="err"><span style="color:#AF1B3F;font-size: 15px;">{{ $_SESSION['result_pass_conf'] }}</span></p>
                    @endif
                <input type="password" name = "pass_conf" placeholder="パスワードを再度ご入力ください。" autocomplete=”off”>
            </div>
            <div class = "login">
                <input type="submit" value = "登録">
            </div>
            <a href="{{ route('home.login') }}">ログイン画面へ戻る</a>
            
        </form>
    </div>

</body>
</html>
<?php
unset($_SESSION['result_name']);
unset($_SESSION['result_uid']);
unset($_SESSION['result_email']);
unset($_SESSION['result_pass']);
unset($_SESSION['result_pass_conf']);
unset($_SESSION['name_ret']);
unset($_SESSION['email_ret']);
unset($_SESSION['uid_ret']);
?>