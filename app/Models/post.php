<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class post extends Model
{
    use HasFactory;

    private $posts;
    private $detail;
    private $id;

    protected $fillable = ['user_id','photo','created_at','bland_id',
        'model','type_id','body','neck','fingerboard','nuts','bridge','machineheads',
        'fret','pickup','control','scale','width_nut','fingerboard_radius',
        'finish','string','custom',];
    public $timestamps = false;

    
    public function posts(){
        if(isset($_POST['category'])){
            $category_id = $_POST['category'];
            $posts = post::select('posts.id as p_id','photo','members.name','members.uid',
            'posts.created_at','user_id','blands.bland','model','body','neck','fingerboard',
            'finish','custom')
            ->join('members','members.id','=','posts.user_id')
            ->join('blands','blands.id','=','posts.bland_id')
            ->join('types','types.id','=','posts.type_id')
            ->WHERE('type_id','=',$category_id)
            ->paginate(8);
            return $posts;
        }else if(isset($_POST['bland_category'])){
            $bland_category_id = $_POST['bland_category'];
            $posts = post::select('posts.id as p_id','photo','members.name','members.uid',
            'posts.created_at','user_id','blands.bland','model','body','neck','fingerboard',
            'finish','custom')
            ->join('members','members.id','=','posts.user_id')
            ->join('blands','blands.id','=','posts.bland_id')
            ->join('types','types.id','=','posts.type_id')
            ->WHERE('bland_id','=',$bland_category_id)
            ->paginate(8);
            return $posts;
        }
        else{
            $posts = post::select('posts.id as p_id','photo','members.name','members.uid',
            'posts.created_at','user_id','blands.bland','model','body','neck','fingerboard',
            'finish','custom')
            ->join('members','members.id','=','posts.user_id')
            ->join('blands','blands.id','=','posts.bland_id')
            ->paginate(8);
            return $posts;
            
        }
    }

    public function post_detail(){
        if(isset($_POST["postId"])){
        $_SESSION['post_id'] = (INT)$_POST["postId"];
        }else{
            
        }
        
        $id = $_SESSION['post_id'];
        $detail = post::select('posts.id as p_id','photo','members.id as m_id','members.name','members.uid',
        'posts.created_at','user_id','blands.bland','model','types.type','body','neck','fingerboard',
        'nuts','bridge','machineheads','fret','pickup','control','scale','width_nut',
        'fingerboard_radius','finish','string','custom')
        ->join('members','members.id','=','posts.user_id')
        ->join('blands','blands.id','=','posts.bland_id')
        ->join('types','types.id','=','posts.type_id')
        ->Where('posts.id','=',$id)
        ->get();
        return $detail;
    }

    public function comment(){
        if(isset($_POST["postId"])){
            $_SESSION['post_id'] = (INT)$_POST["postId"];
        }else{
            
        }
            
        $id = $_SESSION['post_id'];
        $comment = comment::select('comments.id','post_id','user_id','comment','members.id as p_id',
        'name','uid')
        ->Where('comments.post_id','=',$id)
        ->join('members','members.id','=','comments.user_id')
        ->get();
        return $comment;
    }

    public function bookmark(){
        $id = $_SESSION['id'];
        $bookmark = post::select('posts.id as p_id','photo','members.name','members.uid',
        'posts.created_at','posts.user_id','blands.bland','model','body','neck','fingerboard',
        'finish','custom')
        ->join('members','members.id','=','posts.user_id')
        ->join('blands','blands.id','=','posts.bland_id')
        ->join('bookmarks','bookmarks.post_id','=','posts.id')
        ->WHERE('bookmarks.user_id','=',$id)
        ->paginate(8);
        return $bookmark;
    }

    public function user_post(){
        $id = $_SESSION['id'];
        $user_post = post::select('posts.id as p_id','photo','members.name','members.uid',
        'posts.created_at','user_id','blands.bland','model','body','neck','fingerboard',
        'finish','custom')
        ->join('members','members.id','=','posts.user_id')
        ->join('blands','blands.id','=','posts.bland_id')
        ->WHERE('user_id','=',$id)
        ->paginate(8);
        return $user_post;
    }

    public function insert(){
        $id = $_SESSION['id'];

        if(isset($_FILES["photo"])){
            $photo=Crypt::encrypt($_FILES["photo"]['name']).".jpg";
            $image = '.' . substr(strrchr($_FILES['photo']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
            $file = "images/post/$photo";
            if (!empty($_FILES['photo']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
                move_uploaded_file($_FILES['photo']['tmp_name'], './images/post/' . $photo);//imagesディレクトリにファイル保存
                if (exif_imagetype($file)) {
                    $message = '画像をアップロードしました';
                } else {
                    $message = '画像ファイルではありません';
                }
            }
        }
        if($_FILES['photo']['name'] == ""){
            $jpg = ".jpg";
            $rename = Crypt::encrypt("noimage.jpg");
            $photo=$rename.$jpg;
            $copy = File::copy("./images/post/noimage.jpg","./images/post/".$photo);
        }

        if(isset($_POST["bland_id"])){
            $bland_id=$_POST["bland_id"]; 
        }else{$bland_id = NULL;}

        if(isset($_POST["model"])){
            $model=$_POST["model"]; 
        }else{$model = NULL;}

        if(isset($_POST["type_id"])){
            $type_id=$_POST["type_id"]; 
        }else{$type_id = NULL;}

        if(isset($_POST["body"])){
            $body=$_POST["body"]; 
        }else{$body= NULL;}

        if(isset($_POST["neck"])){
            $neck=$_POST["neck"]; 
        }else{$neck= NULL;}

        if(isset($_POST["fingerboard"])){
            $fingerboard=$_POST["fingerboard"]; 
        }else{$fingerboard = NULL;}

        if(isset($_POST["nuts"])){
            $nuts=$_POST["nuts"]; 
        }else{$nuts = NULL;}

        if(isset($_POST["bridge"])){
            $bridge=$_POST["bridge"]; 
        }else{$bridge = NULL;}

        if(isset($_POST["machineheads"])){
            $machineheads=$_POST["machineheads"]; 
        }else{$machineheads = NULL;}

        if(isset($_POST["fret"])){
            $fret=$_POST["fret"]; 
        }else{$fret = NULL;}

        if(isset($_POST["pickup"])){
            $pickup=$_POST["pickup"]; 
        }else{$pickup = NULL;}

        if(isset($_POST["control"])){
            $control=$_POST["control"]; 
        }else{$control = NULL;}

        if(isset($_POST["scale"])){
            $scale=$_POST["scale"]; 
        }else{$scale = NULL;}

        if(isset($_POST["width_nut"])){
            $width_nut=$_POST["width_nut"]; 
        }else{$width_nut= NULL;}

        if(isset($_POST["fingerboard_radius"])){
            $fingerboard_radius=$_POST["fingerboard_radius"]; 
        }else{$fingerboard_radius = NULL;}

        if(isset($_POST["finish"])){
            $finish=$_POST["finish"]; 
        }else{$finish = NULL;}

        if(isset($_POST["string"])){
            $string=$_POST["string"]; 
        }else{$string = NULL;}

        if(isset($_POST["custom"])){
            $custom=$_POST["custom"]; 
        }else{$custom = NULL;}



        $insert = post::create([
            'user_id'=>$id,
            'photo'=>$photo,
            'created_at'=> now(),
            'bland_id'=>$bland_id,
            'model'=>$model,
            'type_id'=>$type_id,
            'body'=>$body,
            'neck'=>$neck,
            'fingerboard'=>$fingerboard,
            'nuts'=>$nuts,
            'bridge'=>$bridge,
            'machineheads'=>$machineheads,
            'fret'=>$fret,
            'pickup'=>$pickup,
            'control'=>$control,
            'scale'=>$scale,
            'width_nut'=>$width_nut,
            'fingerboard_radius'=>$fingerboard_radius,
            'finish'=>$finish,
            'string'=>$string,
            'custom'=>$custom,
        ]);

        return $insert;
    }

    public function delete(){
        $postId = $_POST['postId'];
        $post = post::where('id','=',$postId)
        ->get();
        // dd($post);
        $del_post = delete_posts::insert([
            'id'=> $post['0']['id'],
            'user_id'=>$post['0']['user_id'],
            'photo'=>$post['0']['photo'],
            'created_at'=> $post['0']['created_at'],
            'bland_id'=>$post['0']['bland_id'],
            'model'=>$post['0']['model'],
            'type_id'=>$post['0']['type_id'],
            'body'=>$post['0']['body'],
            'neck'=>$post['0']['neck'],
            'fingerboard'=>$post['0']['fingerboard'],
            'nuts'=>$post['0']['nuts'],
            'bridge'=>$post['0']['bridge'],
            'machineheads'=>$post['0']['machineheads'],
            'fret'=>$post['0']['fret'],
            'pickup'=>$post['0']['pickup'],
            'control'=>$post['0']['control'],
            'scale'=>$post['0']['scale'],
            'width_nut'=>$post['0']['width_nut'],
            'fingerboard_radius'=>$post['0']['fingerboard_radius'],
            'finish'=>$post['0']['finish'],
            'string'=>$post['0']['string'],
            'custom'=>$post['0']['custom'],
        ]);
        $delete = post::where('id','=',$postId)
        ->delete();

        $photo = File::move('./images/post/' . $post['0']['photo'],'./images/delete/' . $post['0']['photo']);
        return;
    }


}
