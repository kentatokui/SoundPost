<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/comment.css">
</head>

    @foreach($comment as $value)
    <div class = "comment_area">
        <div class = "user_info">
        <h3>COMMENT</h3>
        <p>{{ $value->name }} / <span>{{ $value->uid }}</span></p>
        <p>{{\Carbon\Carbon::parse($value->created_at)->format('Y/m/d')}}</p>
        </div>
        
        <p class = "comment_detail">{!! nl2br(e($value->comment)) !!}</p>
        @if(isset($_SESSION['id']))
            @if($_SESSION['id'] == $value['user_id'])
                    @if($value->user_id == $_SESSION['id'])
                    <form method = "post">
                        @csrf
                        <input type="hidden" name = 'id' value = "{{ $value->id }}">
                        <input formaction="{{ route('home.comment_delete') }}" type="submit" class="button2" value="削除">
                    </form>
                    @endif
            @else
            <p></p>
            @endif
        @endif
    </div>
    @endforeach
