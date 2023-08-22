<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton&family=Black+Ops+One&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/top_post.css">
<?php

?>
<body  id = "body">
    <div class = "post">
    @foreach($posts as $post)
        <div class = "content">
            <form action="{{ route('home.post') }}" method = "post">
            @csrf
            <input type="hidden" name="postId" value="{{ $post->p_id }}">
            <div class = "image ">
                <img src="../images/post/{{ $post->photo }}" alt="写真">
            </div>
            <div class = "post_info">
                    <span class = "UserName">{{ $post->name }}</span>
                    <span>&ensp;/&ensp;</span>
                    <span class = "UserId">{{ $post->uid }}</span>
                    </br>
                    <p class = "post_day">{{\Carbon\Carbon::parse($post->created_at)->format('Y/m/d')}}</p>
            </div>
            <input type="hidden" name="userId" value="{{ $post->user_id }}">
            @if(isset($_SESSION['id']))
            <input type="hidden" name="login_user_Id" value="{{ $_SESSION['id'] }}">
            @endif
            <ul class = "detail">
                <li class = "title">Bland</li>
                <li class = "post_detail">{{ $post->bland }}</li>
            </ul>
            <ul class = "detail">
                <li class = "title">Model</li>
                <li class = "post_detail">{{ $post->model }}</li>
            </ul>
            <div class = "hidden">
                <ul class = "material">
                    <li class = "title">&emsp;</li>
                </ul>
                <ul class = "detail">
                    <li class = "title">Body</li>
                    <li class = "post_detail">{{ $post->body }}</li>
                </ul>
                <ul class = "detail">
                    <li class = "title">Neck</li>
                    <li class = "post_detail">{{ $post->neck }}</li>
                </ul>
                <ul class = "detail">
                    <li class = "title">FingerBoard</li>
                    <li class = "post_detail">{{ $post->fingerboard }}</li>
                </ul>
                <ul class = "detail">
                    <li class = "title">Finish</li>
                    <li class = "post_detail">{{ $post->finish }}</li>
                </ul>
                <ul class = "custom">
                    <li class = "title">Custom</li>
                    <li class = "custom_detail">{{ $post->custom }}</li>
                </ul>
            </div>
            <ul class = "custom">
                <input formaction="{{ route('home.post') }}" type="submit" class="button" value="詳細">
                @if(isset($_SESSION['id']))
                    @if($post->user_id == $_SESSION['id'])
                    <input formaction="{{ route('home.post_delete') }}" type="submit" class="button2" value="削除">
                    @endif
                @endif
            </ul>
            </form>
        </div>
        @endforeach
    </div>

<div class="pagination">
{{ $posts->links('pagination::bootstrap-4') }}
</div>
</body>

