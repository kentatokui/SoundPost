<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class member extends Model
{
    use HasFactory;


    private $members;

    protected $fillable = ['name','uid','email','role','password','del_flg'];
    public $timestamps = false;

    public function members(){
        $members = member::WHERE('del_flg','=',0)
        ->paginate(10);
        return $members;
    }

    public function member_res(){

        if(isset($_POST['ticket'])){
        unset($_SESSION['result_name']); 
        unset($_SESSION['result_uid']);
        unset($_SESSION['result_email']);
        unset($_SESSION['result_pass']);
        unset($_SESSION['result_pass_conf']);
        
        $_SESSION['result_name'] = "";
            if(empty($_POST["name"]) || mb_strlen($_POST['name']) >= 10){
                $_SESSION['result_name'] = "ユーザー名は10文字以内で必ずご入力ください。";
            }
        $_SESSION['name_ret'] = "";
                if(!empty($_POST["name"])){
                $_SESSION['name_ret'] = "{$_POST['name']}";
                }
        //ユーザーID
        $_SESSION['result_uid'] = "";
            if(empty($_POST["uid"]) || mb_strlen($_POST['uid']) >= 10 || !preg_match("/^[a-zA-Z0-9]+$/",$_POST["uid"])){
                $_SESSION['result_uid'] = "ユーザーIDは半角英数字10文字以内で必ずご入力ください。";
            }
        $_SESSION['uid_ret'] = "";
            if(!empty($_POST["uid"])){
                $_SESSION['uid_ret'] = "{$_POST['uid']}";
            }
        //メールアドレス
        $_SESSION['result_email'] = "";
                $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
            if($email == false){
                $_SESSION['result_email'] = "メールアドレスは正しくご入力ください。";
            } 
        $_SESSION['email_ret'] = "";
            if(!empty($_POST["email"])){
                $_SESSION['email_ret'] = "{$_POST['email']}";
            }
        //パスワード
        $_SESSION['result_pass'] = "";
        if(isset($_POST['password'])){
            $pass = $_POST['password'];
            if(!preg_match("/\A[a-z\d]{8,100}+\Z/i",$pass)){
                $_SESSION['result_pass'] = "パスワードは英数字8文字以上100文字以下にしてください";
            }
        }else{
            $_SESSION['result_pass'] = "パスワードは英数字8文字以上100文字以下でご入力下さい。";
        }
        //パスワード確認用
        $_SESSION['result_pass_conf'] = "";
        if(isset($_POST['pass_conf'])){
            $pass = $_POST['password'];
            $pass_conf = $_POST['pass_conf'];
            if($pass !== $pass_conf){
                $_SESSION['result_pass_conf'] = "確認用パスワードが異なっています";
            }
        }else{
            $_SESSION['result_pass_conf'] = "確認用パスワードが異なっています";
        }
        $uid_err = member::WHERE('uid','=','@'.$_POST['uid'])->get();
        if(!empty($uid_err['0']['uid'])){
            $_SESSION['result_uid'] = "ユーザーIDが重複しています。他のユーザーIDをご使用ください。";
        }

        if(!empty($_SESSION['result_name']) || 
                !empty($_SESSION['result_uid']) ||
                !empty($_SESSION['result_email']) ||
                !empty($_SESSION['result_pass']) ||
                !empty($_SESSION['result_pass_conf'])){
                        return redirect()->to('member_res')->send();
                        
            }else{
                unset($_SESSION['name_ret']); 
                unset($_SESSION['uid_ret']);
                unset($_SESSION['email_ret']);
                unset($_SESSION['pass_ret']);
                unset($_SESSION['pass_conf_ret']);
                $uid = "@".$_POST['uid'];
                $member = member::create([
                    'name'=>$_POST['name'],
                    'uid'=>$uid,
                    'email'=>$_POST['email'],
                    'role'=>0,
                    'password'=>Hash::make($_POST['password']),
                    'del_flg'=>0,
                    'created_at'=>now(),
                ]);

                return $member;
            }
        }else{
            return redirect()->to('index')->send();
        }
    }

    public function login(){
        // $email = $_POST['login_email'];
        // $pass = $_POST['login_pass'];
        $email = request()->get('email');
        $pass = request()->get('pass');
        if(isset($email)){
        $member = member::WHERE('email','=',$email)->first();
        }else{
            $_SESSION['email_err'] = "※メールアドレスを入力してください。";
            $_SESSION['pass_err'] = "※パスワードを入力してください。";
            return redirect()->to('login')->send();
        }
        if($member != NULL){
            $hash_pass = $member['password'];
            if($member['del_flg'] == 1){
                $_SESSION['email_err'] = "※アカウントが存在しません。";
                return redirect()->to('login')->send();
            }else if (password_verify($pass,$hash_pass)) {
                //DBのユーザー情報をセッションに保存(ログイン保持用)
                $_SESSION['email'] = $member['email'];
                $_SESSION['role'] = $member['role'];
                $_SESSION['id'] = $member['id'];
                $_SESSION['uid'] = $member['uid'];
                $_SESSION['name'] = $member['name'];
                $_SESSION['create'] = $member['created_at'];
                $_SESSION['login_key'] = "already_login";
                return ;
            }else if (!password_verify($pass,$hash_pass)) {
                $_SESSION['input_email'] = $email;
                $_SESSION['pass_err'] = '※パスワードが間違っています。';
                return redirect()->to('login')->send();
            return ;
            }
        }else {
            $_SESSION['input_email'] = $email;
            $_SESSION['e_p_err'] = '※メールアドレスもしくはパスワードが間違っています。';
            return redirect()->to('login')->send();
        }
    }

    public function change_pass(){
        $email = request()->get('email');
        $uid = request()->get('uid');
        $new_pass = request()->get('new_pass');
        $new_pass_conf = request()->get('new_pass_conf');

        if(!isset($email) && !isset($uid) &&!isset($new_pass) && !isset($new_pass_conf)){
            $_SESSION['email_err'] = "※メールアドレスを入力してください。";
            $_SESSION['uid_err'] = "※@から始まるユーザーIDを入力してください。";
            $_SESSION['new_pass_err'] = "※新規パスワードを入力してください。";
            $_SESSION['pass_conf_err'] = "確認用パスワードが一致しません。";
            return redirect()->to('change_pw')->send();
        }else if(!isset($email)){
            $_SESSION['email_err'] = "※メールアドレスを入力してください。";
            return redirect()->to('change_pw')->send();
        }else if(!isset($uid)){
            $_SESSION['input_email'] = $email;
            $_SESSION['uid_err'] = "※@から始まるユーザーIDを入力してください。";
            return redirect()->to('change_pw')->send();
        }else if(!isset($new_pass)){
            $_SESSION['input_email'] = $email;
            $_SESSION['new_pass_err'] = "※新規パスワードを入力してください。";
            return redirect()->to('change_pw')->send();
        }elseif(!isset($new_pass_conf)){
            $_SESSION['input_email'] = $email;
            $_SESSION['pass_conf_err'] = "確認用パスワードが一致しません。";
            return redirect()->to('change_pw')->send();
        }else{
            $member = member::WHERE('email','=',$email)->first();
        }
        
        if($member != NULL){
            $conf_uid = $member['uid'];
            if ($email == $member['email'] && $uid == $conf_uid) {
                if($new_pass != $new_pass_conf){
                    $_SESSION['pass_conf_err'] = "確認用パスワードが一致しません。";
                    return redirect()->to('change_pw')->send();
                }else{
                    $change = member::WHERE('id','=',$member['id'])
                    ->update(['password'=>Hash::make($new_pass)]);
                    return redirect()->to('login')->send();
                }
                return ;
            }else if ($email != $member['email'] || $uid != $conf_uid) {
                $_SESSION['input_email'] = $email;
                $_SESSION['email_err'] = 'メールアドレスとユーザーIDが一致しません。';
                return redirect()->to('change_pw')->send();
            return ;
            }
        }else {
            $_SESSION['input_email'] = $email;
            $_SESSION['e_p_err'] = '※メールアドレスもしくはユーザーIDが間違っています。';
            return redirect()->to('change_pw')->send();
        }
    }

    public function manage(){
        $id = $_POST['id'];

        $manage = member::where('id','=',$id)->get();
        return $manage;
    }



    public function edit(){
        $edit = member::where('id','=',$_POST['id'])
        ->update([
            'name'=>$_POST['name'],
            'uid'=>$_POST['uid'],
            'email'=>$_POST['email'],
            'role'=>$_POST['role'],
        ]);
        return redirect()->to('user_manage')->send();
    }

    public function withdrawal(){
        $id = $_SESSION['id'];
        $del_id = $_SESSION['id'];
        $withdrawal = member::where('id','=',$id)
        ->update(['del_flg'=>1]);

        //コメントを削除フォルダへ移動
        $comment = comment::where('user_id','=',$del_id)
        ->get();

        foreach($comment as $com){
            $comment_delete = delete_comments::insert([
            'id'=>$com['id'],
            'user_id'=>$com['user_id'],
            'post_id'=>$com['post_id'],
            'comment'=>$com['comment'],
            'updated_at'=>$com['updated_at'],
        ]);
        }

        $del = comment::where('user_id','=',$del_id)
        ->delete();

        //投稿を削除フォルダへ移動
        $posts = post::where('user_id','=',$del_id)
        ->get();
        // dd($post);
        foreach($posts as $post){
        $del_post = delete_posts::insert([
            'id'=> $post['id'],
            'user_id'=>$post['user_id'],
            'photo'=>$post['photo'],
            'created_at'=> $post['created_at'],
            'bland_id'=>$post['bland_id'],
            'model'=>$post['model'],
            'type_id'=>$post['type_id'],
            'body'=>$post['body'],
            'neck'=>$post['neck'],
            'fingerboard'=>$post['fingerboard'],
            'nuts'=>$post['nuts'],
            'bridge'=>$post['bridge'],
            'machineheads'=>$post['machineheads'],
            'fret'=>$post['fret'],
            'pickup'=>$post['pickup'],
            'control'=>$post['control'],
            'scale'=>$post['scale'],
            'width_nut'=>$post['width_nut'],
            'fingerboard_radius'=>$post['fingerboard_radius'],
            'finish'=>$post['finish'],
            'string'=>$post['string'],
            'custom'=>$post['custom'],
        ]);

        $photo = File::move('./images/post/' . $post['photo'],'./images/delete/' . $post['photo']);
        }
        $delete = post::where('user_id','=',$del_id)
        ->delete();

        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['id']);
        unset($_SESSION['uid']);
        unset($_SESSION['name']);
        unset($_SESSION['login_key']);
        return;
    }

    public function withdrawal_admin(){
        $id = $_POST['id'];
        $del_id = $_POST['id'];
        $withdrawal = member::where('id','=',$id)
        ->update(['del_flg'=>1]);

        //コメントを削除フォルダへ移動
        $comment = comment::where('user_id','=',$del_id)
        ->get();

        foreach($comment as $com){
            $comment_delete = delete_comments::insert([
            'id'=>$com['id'],
            'user_id'=>$com['user_id'],
            'post_id'=>$com['post_id'],
            'comment'=>$com['comment'],
            'updated_at'=>$com['updated_at'],
        ]);
        }

        $del = comment::where('user_id','=',$del_id)
        ->delete();

        //投稿を削除フォルダへ移動
        $posts = post::where('user_id','=',$del_id)
        ->get();
        // dd($post);
        foreach($posts as $post){
        $del_post = delete_posts::insert([
            'id'=> $post['id'],
            'user_id'=>$post['user_id'],
            'photo'=>$post['photo'],
            'created_at'=> $post['created_at'],
            'bland_id'=>$post['bland_id'],
            'model'=>$post['model'],
            'type_id'=>$post['type_id'],
            'body'=>$post['body'],
            'neck'=>$post['neck'],
            'fingerboard'=>$post['fingerboard'],
            'nuts'=>$post['nuts'],
            'bridge'=>$post['bridge'],
            'machineheads'=>$post['machineheads'],
            'fret'=>$post['fret'],
            'pickup'=>$post['pickup'],
            'control'=>$post['control'],
            'scale'=>$post['scale'],
            'width_nut'=>$post['width_nut'],
            'fingerboard_radius'=>$post['fingerboard_radius'],
            'finish'=>$post['finish'],
            'string'=>$post['string'],
            'custom'=>$post['custom'],
        ]);

        $photo = File::move('./images/post/' . $post['photo'],'./images/delete/' . $post['photo']);
        }
        $delete = post::where('user_id','=',$del_id)
        ->delete();

        return;
    }
}
