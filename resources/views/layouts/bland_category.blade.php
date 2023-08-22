<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/category_list.css">

    <title>Document</title>
</head>
<body>
    <div class = "category_background">
        <div class = "category_list">
        @foreach($bland_category as $bland)
        <form action="{{ route('home.index') }}" method = 'POST'>
                @csrf
                <input type="hidden" name = "bland_category" value="{{ $bland->id }}">
                <button type = 'submit'>{{ $bland->bland }}</button>
            </form>
        @endforeach
        </div>
    </div>
</body>
</html>