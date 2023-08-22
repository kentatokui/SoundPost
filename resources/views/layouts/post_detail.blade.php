<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/post.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @foreach($detail as $value)
    
    <div class = "main_detail">
        <div class = "im">
            <div  class = "image">
                <img src="../images/post/{{ $value->photo }}" alt="写真">
            </div>
            <div class = "custom">
                <h2>CUSTOM</h2>
                <p>{{ $value->custom }}</p>
            </div>
            @if(isset($_SESSION['login_key']))
                @if(!isset($already_bookmark))
                <div class = "button">
                        <!-- ブックマーク登録用 -->
                        <input type="hidden" name = "p_id" value = "{{ $value->p_id }}">
                        <input type="hidden" name = "u_id" value = "{{ $_SESSION['id'] }}">
                        <button id="bookmark" class="bookmark liked">BookMark</button>
                        <!-- ブックマーク登録用 -->
                </div>
                @else
                <div class = "button_b">
                        <!-- ブックマーク登録用 -->
                        <input type="hidden" name = "p_id" value = "{{ $value->p_id }}">
                        <!-- ↓ここの値はログインしている人のidをセッションから取得してvalueに入れる。↓ -->
                        <input type="hidden" name = "u_id" value = "{{ $_SESSION['id'] }}">
                        <button id="bookmark" class="bookmark_b liked_b">BookMark</button>
                        <!-- ブックマーク登録用 -->
                </div>
                @endif
            @endif
            @if(isset($_SESSION['comment_err']))
            <p><span style = color:#AF1B3F;>{{ $_SESSION['comment_err'] }}</span></p>
            @endif
            <?php unset($_SESSION['comment_err']); ?>
            <button id = "comment" class = "c_button">comment</button>
        </div>
        <div class = "detail">
            <ul>
                <li class ="title">User_name / <span>user_id</span></li>
                <li class ="content">{{ $value->name }}/ <span>{{ $value->uid }}</span></li>
            </ul>
            <ul>
                <li class ="title">Post Day</li>
                <li>{{\Carbon\Carbon::parse($value->created_at)->format('Y/m/d')}}</li>
            </ul>
            <ul>
                <li class ="title">Bland</li>
                <li>{{ $value->bland }}</li>
            </ul>
            <ul>
                <li class ="title">Model</li>
                <li class ="content">{{ $value->model }}</li>
            </ul>
            <ul>
                <li class ="title">Type</li>
                <li>{{ $value->type }}</li>
            </ul>
            <h3  class ="material_title">-material-</h3>
            <ul>
                <li class ="title">Body</li>
                <li class ="content">{{ $value->body }}</li>
            </ul>
            <ul>
                <li class ="title">Neck</li>
                <li class ="content">{{ $value->neck }}</li>
            </ul>
            <ul>
                <li class ="title">FingerBoard</li>
                <li class ="content">{{ $value->fingerboard }}</li>
            </ul>
            <ul>
                <li class ="title">Nuts</li>
                <li class ="content">{{ $value->nuts }}</li>
            </ul>
            <ul>
                <li class ="title">Bridge</li>
                <li class ="content">{{ $value->bridge }}</li>
            </ul>
            <ul>
                <li class ="title">MachineHeads</li>
                <li class ="content">{{ $value->machineheads }}</li>
            </ul>
            <ul>
                <li class ="title">Fret</li>
                <li class ="content">{{ $value->fret }}</li>
            </ul>
            <ul>
                <li class ="title">PickUp</li>
                <li class ="content">{{ $value->pickup }}</li>
            </ul>
            <ul>
                <li class ="title">control</li>
                <li class ="content">{{ $value->control }}</li>
            </ul>
            <ul>
                <li class ="title">Scale</li>
                <li class ="content">{{ $value->scale }}</li>
            </ul>
            <ul>
                <li class ="title">Width At Nut</li>
                <li>{{ $value->width_nut}}</li>
            </ul>
            <ul>
                <li class ="title">FingerBoardRadius</li>
                <li>{{ $value->fingerboard_radius}}</li>
            </ul>
            <ul>
                <li class ="title">Finish</li>
                <li class = "finish content">{{ $value->finish }}</li>
            </ul>
            <ul>
                <li class ="title">String</li>
                <li class ="content">{{ $value->string }}</li>
            </ul>
        </div>
    </div>
    <div class="comment_inp comment_hide" id = "com">
    <form action="{{ route('home.comment_post') }}" method="post">
        @csrf
        <input type="hidden" name="m_id" value="{{ $_SESSION['id'] }}">
        <input type="hidden" name="postId" value="{{ $value->p_id }}">
        <textarea name="comment" class ="post" placeholder="comment"></textarea>
        <input type="submit" class = "button" value="投稿">
    </form>
    @endforeach
</div>
</body>
</html>

<script>
    $('#comment').on('click', function() {
        $(".comment_inp").toggleClass("comment_hide")
    });

</script>

<script>
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
        })
        $('#bookmark').on('click', function(){
            p_id = $('input[name="p_id"]').val();
            u_id = $('input[name="u_id"]').val();
            $.ajax({
                url: "{{ route('bookmark_res') }}",
                method: "POST",
                data: { p_id : p_id ,u_id : u_id },
                dataType: "json",
            }).done(function(res){
                $("#bookmark").toggleClass('liked liked_b');
            }).faile(function(){
                alert('通信の失敗をしました');
            });
        });
    </script>