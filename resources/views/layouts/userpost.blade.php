<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/top_post.css">
    <title>Document</title>
</head>

<body  id = "body">
    <div class = "post">
    @foreach($user_post as $post)
        <div class = "content">
            <form action="{{ route('home.post') }}" method = "post">
            @csrf
            <input type="hidden" name="postId" value="{{ $post->p_id }}">
            <div class = "image ">
                <input type="hidden" name="photo" value="{{ $post->photo }}">
                <img src="../images/post/{{ $post->photo }}" alt="写真">
            </div>
            <div class = "post_info">
                    <span class = "UserName">{{ $post->name }}</span>
                    <span>&ensp;/&ensp;</span>
                    <span class = "UserId">{{ $post->uid }}</span>
                    </br>
                    <p class = "post_day">{{\Carbon\Carbon::parse($post->created_at)->format('Y/m/d')}}</p>
            </div>
            <input type="hidden" name="userId" value="{{ $_SESSION['id'] }}">
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
                <input formaction="{{ route('home.mypost_delete') }}" type="submit" class="button2" value="削除">
            </ul>
            </form>
        </div>
        @endforeach
    </div>

<div class="pagination">
{{ $user_post->links('pagination::bootstrap-4') }}
</div>
</body>