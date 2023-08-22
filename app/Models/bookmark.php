<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bookmark extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id','post_id'];

    public function already_bookmark(){
        $p_id = request()->get('p_id');
        $u_id = request()->get('u_id');
        $already_bookmark = bookmark::select('id','user_id','post_id')
        ->where('user_id','=',$u_id)
        ->where('post_id','=',$p_id)
        ->first();
        return $already_bookmark;
    }

    public function already_bookmark_a(){
        $p_id = request()->get('postId');
        $u_id = request()->get('login_user_Id');
        $already_bookmark = bookmark::select('id','user_id','post_id')
        ->where('user_id','=',$u_id)
        ->where('post_id','=',$p_id)
        ->first();
        return $already_bookmark;
    }

    public function bookmark(){
        $p_id = request()->get('p_id');
        $u_id = request()->get('u_id');
        $already_bookmark = bookmark::select('id','user_id','post_id')
        ->where('user_id','=',$u_id)
        ->where('post_id','=',$p_id)
        ->first();
        

        if(!isset($already_bookmark)){
            $name = bookmark::create([
                'user_id'=>$u_id,
                'post_id'=>$p_id,
            ]);
        }
        if(isset($already_bookmark)){
            $name = bookmark::where('user_id','=',$u_id)
            ->where('post_id','=',$p_id)->delete();
        }
    }
    

}
