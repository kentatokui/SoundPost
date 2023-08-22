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
        <p>会員登録が完了いたしました。</p>
        <P>下記のボタンよりお戻りください。</P>
        <div class = "login">
            <button><a href="{{ route('home.login') }}">ログインページへ</a></button>
        </div>
    </div>
<script>
    window.onload = function() {
    history.pushState(null, null, null);

    window.addEventListener("popstate", function (e) {
    history.pushState(null, null, null);
    return;
    });
    };
    document.addEventListener("keydown", function (e) {
    
    if ((e.which || e.keyCode) == 116 ) {
        e.preventDefault();
    }

    });
    window.addEventListener('beforeunload', (e) => {
        window.location.href = "{{ route('home.index') }}";
    });
</script>
</body>
</html>