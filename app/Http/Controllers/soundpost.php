<?php

namespace App\Http\Controllers;

session_cache_limiter('private_no_expire');
session_start();

use Illuminate\Http\Request;

use App\Models\type;
use App\Models\bland;
use App\Models\member;
use App\Models\comment;
use App\Models\post;
use App\Models\bookmark;



class soundpost extends Controller{

    private $category;
    private $bland_category;
    private $member;
    private $comment;
    private $post;
    private $bookmark;

    public function __construct() {
        $this->category = new type();
        $this->bland_category = new bland();
        $this->member = new member();
        $this->comment = new comment();
        $this->post = new post();
        $this->bookmark = new bookmark();
    }

    //
    public function index(){
        $posts = $this->post->posts();
        $already_bookmark = $this->bookmark->already_bookmark_a();
        return view('main.index',compact('posts','already_bookmark'));
    }
    //
    public function category(){
        $category = $this->category->category();
        return view('main.category',['category' => $category]);
    }
    //
    public function bland_category(){
        $bland_category = $this->bland_category->bland_category();
        return view('main.bland_category',['bland_category' => $bland_category]);
    }
    //投稿情報取得
    public function post(){
        $detail = $this->post->post_detail();
        $comment = $this->post->comment();
        $already_bookmark = $this->bookmark->already_bookmark_a();
        return view('main.post',compact('detail','comment','already_bookmark'));
    }
    //ログイン画面表示のみ
    public function login(){
        return view('main.login');
    }
    //ログアウト処理
    public function logout(){
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['id']);
        unset($_SESSION['login_key']);
        return redirect('/')->with('logout', 'ログアウトしました。');
    }
    //ログイン処理可能
    public function login_process(){
        $login = $this->member->login();
        return redirect('mypage');
    }
    //パスワード変更ページ表示
    public function change(){
        return view('main.change_pw');
    }
    //パスワード変更処理
    public function change_pass(){
        $change = $this->member->change_pass();
        return redirect('login/')->with('change', 'パスワードを変更しました。');
    }
    //投稿作成
    public function create(){
        $category = $this->category->category();
        $bland_category = $this->bland_category->bland_category();
        return view('main.create',compact('category','bland_category'));
    }
    //投稿完了
    public function post_complete(){
        $insert = $this->post->insert();
        return redirect('mypage/');
    }
    //投稿削除処理
    public function mypost_delete(){
        $post_delete = $this->post->delete();
        return redirect('mypage/');
    }
    public function post_delete(){
        $post_delete = $this->post->delete();
        return redirect('index/');
    }
    //投稿へのコメント作成処理
    public function comment_post(){
        if(!isset($_SESSION['login_key'])){
            return redirect('post/')->with('comment', 'この機能を利用するにはログインしてください。');
        }
        $comment_post = $this->comment->comment_post();
        return redirect()->to('post')->send();
    }
    //コメント削除
    public function comment_delete(){
        $comment_delete = $this->comment->delete();
        return redirect('post/');
    }
    //マイページ表示処理
    public function MyPage(){
        if(!isset($_SESSION['login_key'])){
            return redirect('/')->with('login', 'ログインしてください。');
        }
        $user_post = $this->post->user_post();
        return view('main.mypage',['user_post' => $user_post]);
    }
    
    //ブックマーク
    public function bookmark(){
        $bookmark = $this->post->bookmark();
        return view('main.bookmark',['bookmark' => $bookmark]);
    }
    //ブックマーク登録処理
    public function bookmark_res(){
        $name = $this->bookmark->bookmark();
        return response()->json($name);
    }
    //会員管理
    public function management(){
        $members = $this->member->members();
        return view('main.user_manage',['members' => $members]);
    }
    //会員情報編集-表示
    public function manage(){
        $manage = $this->member->manage();
        return view('main.manage',['manage' => $manage]);
    }
    //会員情報編集-登録
    public function m_edit(){
        $edit = $this->member->edit();
        return view('main.user_manage');
    }
    //会員登録
    public function member_res(){
        return view('main.member_res');
    }
    //会員登録完了
    public function member_comp(){
        $member = $this->member->member_res();
        return view('main.member_comp',['member' => $member]);
    }
    //退会
    public function withdrawal(){
        $withdrawal = $this->member->withdrawal();
        return redirect('/')->with('withdrawal', '退会しました。');
    }
    //ユーザー管理_退会
    public function withdrawal_admin(){
        $withdrawal = $this->member->withdrawal_admin();
        return redirect('user_manage');
    }

}


