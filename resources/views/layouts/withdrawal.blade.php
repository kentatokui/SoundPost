<link rel="stylesheet" href="/css/withdrawal.css">
<div class = "login_form">
        <form >
            @csrf
            <div>
                <input type="hidden" name = "name" placeholder="UserId"
                value = "SESSION UserID?">
            </div>
            <div class = "login">
                <p>本当に退会いたしますが、よろしいですか？</p>
                <input formaction="#"type="submit" value = "退会">
            </div>
            
        </form>
        <div>
            <div class = "login">
                <a href="{{ route('home.mypage') }}"><button type ="button" >戻る</button></a>
            </div>
        </div>
    </div>