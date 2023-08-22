<link rel="stylesheet" href="/css/userpost.css">

<section class = "background">
    <div class = "userinfo">
        <div class = "user">
            <p>{{ $_SESSION['name'] }}</p>
            <p>{{ $_SESSION['uid'] }}</p>
            <p><span>登録日 : </span>{{\Carbon\Carbon::parse($_SESSION['create'])->format('Y/m/d')}}</p>
        </div>
        <div class = "information">
            <form method = "">
                @csrf
                <input formaction="{{ route('home.create') }}" class = "post_button" type="submit" name = "" value = "投稿">
                <input formaction="送信先のアドレス" type="hidden" name = "" value = "UserID">
                <input formaction="{{ route('home.bookmark') }}"type="submit" name = "" value = "ブックマーク一覧">
                <input formaction="{{ route('home.logout') }}"type="submit" name = "" value = "ログアウト">
                <input formaction="{{ route('home.withdrawal') }}"type="submit" onclick="return clickDisplayAlert()" value = "退会">
                @if($_SESSION['role'] == 1)
                <input formaction="{{ route('home.management') }}"type="submit" name = "" value = "ユーザー管理">
                @endif
            </form>
        </div>
    </div>
    <script>
        function delete(){
        if(window.confirm("本当に退会しますか？")){
            alert("aaa");
            location.href = "{{ route('home.index') }}";
        }else{
            return false;
        }
        }
    </script>

    <script>
        function clickDisplayAlert() {
        if(window.confirm("本当に退会しますか？")){
            
        }else{
            return false;
        }
        }
    </script>
</section>