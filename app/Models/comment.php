<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','post_id','comment',];

    public $timestamps = false;

    public function comment_post(){
        $comment = $_POST['comment'];
        $user = $_POST['m_id'];
        $post_id = $_POST['postId'];
        
        if($_POST['comment'] != ""){
            $comment_post = comment::create([
                'user_id'=>$user,
                'post_id'=>$post_id,
                'comment'=>$comment,
                'updated_at'=>now(),
            ]);
        }else{
            $_SESSION['comment_err'] = "コメントを入力してください。";
            return redirect()->to('post')->send();
        }

        return;
    }

    public function delete(){
        $id = $_POST['id'];
        $comment = comment::where('id','=',$id)
        ->get();

        $comment_delete = delete_comments::insert([
            'id'=>$comment['0']['id'],
            'user_id'=>$comment['0']['user_id'],
            'post_id'=>$comment['0']['post_id'],
            'comment'=>$comment['0']['comment'],
            'updated_at'=>$comment['0']['updated_at'],
        ]);

        $del = comment::where('id','=',$id)
        ->delete();
        
        return;
    }
}
