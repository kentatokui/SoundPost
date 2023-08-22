<link rel="stylesheet" href="/css/create.css">


<div class = "create">
    <form action="{{ route('home.post_complete') }}" method="post" enctype="multipart/form-data">
    @csrf
        <ul>
            <li class = "title">Photo</li>
            @if(isset($_SESSION['photo_err']))
            <li class = "title"><span style="color:#AF1B3F">{{ $_SESSION['photo_err'] }}</span></li>
            @endif
            <li><input type="file" name = 'photo' placeholder="xxxxxxxx" accept=".jpg,.jpeg,.JPG,.JPEG,.png,.PNG" required></li>
        </ul>
        <ul>
            <li class = "title">Bland <span style="color:#AF1B3F"></span> </li>
            <li>
                <select name="bland_id" id="">
                    @foreach($bland_category as $bland)
                    <option value="{{ $bland->id }}">{{ $bland->bland }}</option>
                    @endforeach
                </select>
            </li>
        </ul>
        <ul>
            <li class = "title">Model</li>
            <li><input type="text" name = 'model' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Type</li>
            <li>
                <select name="type_id" id="">
                    @foreach($category as $type)
                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                    @endforeach
                </select>
            </li>
        </ul>
        <h2>material</h2>
        <ul>
            <li class = "title">Body</li>
            <li><input type="text" name = 'body' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Neck</li>
            <li><input type="text" name = 'neck' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">FingerBoard</li>
            <li><input type="text" name = 'fingerboard' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Nuts</li>
            <li><input type="text" name = 'nuts' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Bridge</li>
            <li><input type="text" name = 'bridge' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">MachineHeads</li>
            <li><input type="text" name = 'machineheads' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Fret</li>
            <li><input type="text" name = 'fret'placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">PickUp</li>
            <li><input type="text" name = 'pickup' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">control</li>
            <li><input type="text" name = 'control' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Scale</li>
            <li><input type="text" name = 'scale' placeholder="xxxxxxxx" maxlength="10"></li>
        </ul>
        <ul>
            <li class = "title">NutWidth</li>
            <li><input type="text" name = 'width_nut' placeholder="xxxxxxxx" maxlength="10"></li>
        </ul>
        <ul>
            <li class = "title">FingerBoardRadius</li>
            <li><input type="text" name = 'fingerboard_radius' placeholder="xxxxxxxx" maxlength="10"></li>
        </ul>
        <ul>
            <li class = "title">Finish</li>
            <li><input type="text" name = 'finish' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">String</li>
            <li><input type="text" name = 'string' placeholder="xxxxxxxx" maxlength="50"></li>
        </ul>
        <ul>
            <li class = "title">Custom</li>
            <li><textarea id="" name ='custom' placeholder="xxxxxxxx" maxlength="500"></textarea></li>
        </ul>
        <ul>
        <input type="button" onclick="submit();" value="投稿" />
        </ul>
    </form>
</div>
<?php
unset($_SESSION['photo_err']);
?>