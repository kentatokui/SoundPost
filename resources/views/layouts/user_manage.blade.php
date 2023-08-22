
<link rel="stylesheet" href="/css/user_manage.css">
<div class="user_manage">
    <ul>
        <li class = "id">ID</li>
        <li class = "name">username</li>
        <li class = "uid">user_id</li>
        <li class = "email">Email</li>
        <li class = "role">role</li>
        <li class = "manage">管理</li>
    </ul>
<!-- foreachで回す-->
@foreach($members as $member)
    <form method="post" action="{{ route('home.manage') }}">
    @csrf
            <ul class = "members">
                <input type="hidden" name='id' value = "{{ $member->id }}">
                <li class = "id">{{ $member->id }}</li>
                <li class = "name">{{ $member->name }}</li>
                <li class = "uid">{{ $member->uid }}</li>
                <li class = "email">{{ $member->email }}</li>
                <li class = "role">{{ $member->role }}</li>
                <li class = "manage"><input type="submit" value = "管理"></li>
            </ul>
    </form>
    @endforeach
</div>
<div class="pagination">
{{ $members->links('pagination::bootstrap-4') }}
</div>
