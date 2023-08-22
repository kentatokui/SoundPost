<link rel="stylesheet" type="text/css" href="/css/category.css">
<?php
$cat_menu = [
    1 => ['StratoCaster'],
    2 => ['TeleCaster'],
    3 => ['LesPaul'],
    22 => ['JazzBass'],
    23 => ['PrecisionBass'],
    29 => ['Other']
];
?>
    <div class = "category">
        <table class = "category_menu">
            <th>
            @foreach($cat_menu as $key => $cat)
                <td>
                <form action="{{ route('home.index') }}" method = "POST">
                @csrf
                    <input type="hidden" name='category' value="{{ $key }}">
                    <button type="submit">{{ $cat[0] }}</button>
                    </form>
                </td>
            @endforeach
            </th>
        </table>
    </div>

    <div class = "media_category">
        <table class = "media_category_menu">
            <form action="{{ route('home.index') }}" method = "POST">
                @csrf
            <th>
                <td><a href="{{ route('home.category') }}"></a>Type category</td>
                <td><a href="{{ route('home.bland_category') }}"></a>Bland category</td>
            </th>
            </form>
        </table>
    </div>


