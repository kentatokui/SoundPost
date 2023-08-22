
<link rel="stylesheet" href="/css/user_manage.css">
<div class="user_manage">
    <ul>
        <li class = "id">ID</li>
        <li class = "name">username</li>
        <li class = "uid">user_id</li>
        <li class = "email">Email</li>
        <li class = "role">role</li>
        <li class = "del">del_flg</li>
        <li class = "manage">更新</li>
    </ul>

    
    <form method="post" action = "{{route('home.member_edit')}}">
        @foreach($manage as $member)
        @csrf
            <ul class = "members">
                <input type="hidden" name="id" value = "{{ $member->id }}">
                <li class = "id">{{ $member->id }}</li>
                <li class = "name"><input type="text" name="name" value="{{ $member->name }}"></li>
                <li class = "uid"><input type="text" name="uid" value="{{ $member->uid }}"></li>
                <li class = "email"><input type="text" name="email" value="{{ $member->email }}"></li>
                <li class = "role">
                    <select name="role" id="">
                        <option value="{{ $member->role }}">{{ $member->role }}</option>
                        <option value="0">一般</option>
                        <option value="1">管理者</option>
                    </select>
                </li>
                <li class = "del">{{ $member->del_flg }}</li>
                <li class = "manage"><input type="submit" value="更新"></li>
                <li class = "manage">
                    <input formaction="{{ route('home.withdrawal_admin') }}"type="submit" onClick="return delete()" value = "退会">
                </li>
            </ul>
        @endforeach
    </form>

</div>
<script>
        function delete(){
        if(window.confirm("本当に退会しますか？")){
            location.href = "{{ route('home.withdrawal') }}";
        }else{
            return false;
        }
        }
    </script>
