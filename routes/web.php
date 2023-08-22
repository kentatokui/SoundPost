<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\soundpost;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ soundpost::class, 'index' ])->name('home.index');
Route::get('/index', [ soundpost::class, 'index' ])->name('home.index');
Route::post('/index', [ soundpost::class, 'index' ])->name('home.index');

Route::get('/category', [ soundpost::class, 'category' ])->name('home.category');
Route::post('/category', [ soundpost::class, 'category' ])->name('home.category');

Route::get('/bland_category', [ soundpost::class, 'bland_category' ])->name('home.bland_category');
Route::post('/bland_category', [ soundpost::class, 'bland_category' ])->name('home.bland_category');

Route::get('/post', [ soundpost::class, 'post' ])->name('home.post');
Route::post('/post', [ soundpost::class, 'post' ])->name('home.post');

Route::get('/login', [ soundpost::class, 'login' ])->name('home.login');
Route::post('/login', [ soundpost::class, 'login' ])->name('home.login');

Route::get('/logout', [ soundpost::class, 'logout' ])->name('home.logout');
Route::post('/logout', [ soundpost::class, 'logout' ])->name('home.logout');

Route::get('/login_process', [ soundpost::class, 'login_process' ])->name('home.login_process');
Route::post('/login_process', [ soundpost::class, 'login_process' ])->name('home.login_process');

Route::get('/member_comp', [ soundpost::class, 'member_comp' ])->name('home.member_comp');
Route::post('/member_comp', [ soundpost::class, 'member_comp' ])->name('home.member_comp');

Route::get('/member_res', [ soundpost::class, 'member_res' ])->name('home.member_res');
Route::post('/member_res', [ soundpost::class, 'member_res' ])->name('home.member_res');

Route::get('/create', [ soundpost::class, 'create' ])->name('home.create');
Route::post('/create', [ soundpost::class, 'create' ])->name('home.create');

Route::get('/post_complete', [ soundpost::class, 'post_complete' ])->name('home.post_complete');
Route::post('/post_complete', [ soundpost::class, 'post_complete' ])->name('home.post_complete');

Route::get('/mypost_delete', [ soundpost::class, 'mypost_delete' ])->name('home.mypost_delete');
Route::post('/mypost_delete', [ soundpost::class, 'mypost_delete' ])->name('home.mypost_delete');

Route::get('/post_delete', [ soundpost::class, 'post_delete' ])->name('home.post_delete');
Route::post('/post_delete', [ soundpost::class, 'post_delete' ])->name('home.post_delete');

Route::get('/mypage', [ soundpost::class, 'mypage' ])->name('home.mypage');
Route::post('/mypage', [ soundpost::class, 'mypage' ])->name('home.mypage');

Route::get('/change_pw', [ soundpost::class, 'change' ])->name('home.change_pw');
Route::post('/change_pw', [ soundpost::class, 'change' ])->name('home.change_pw');

Route::get('/change_pass', [ soundpost::class, 'change_pass' ])->name('home.change_pass');
Route::post('/change_pass', [ soundpost::class, 'change_pass' ])->name('home.change_pass');

Route::get('/bookmark', [ soundpost::class, 'bookmark' ])->name('home.bookmark');
Route::post('/bookmark', [ soundpost::class, 'bookmark' ])->name('home.bookmark');

Route::post('/bookmark_res', [ soundpost::class, 'bookmark_res' ])->name('bookmark_res');

Route::get('/comment_post', [ soundpost::class, 'comment_post' ])->name('home.comment_post');
Route::post('/comment_post', [ soundpost::class, 'comment_post' ])->name('home.comment_post');

Route::get('/comment_delete', [ soundpost::class, 'comment_delete' ])->name('home.comment_delete');
Route::post('/comment_delete', [ soundpost::class, 'comment_delete' ])->name('home.comment_delete');

Route::get('/user_manage', [ soundpost::class, 'management' ])->name('home.management');
Route::post('/user_manage', [ soundpost::class, 'management' ])->name('home.management');

Route::get('/manage', [ soundpost::class, 'manage' ])->name('home.manage');
Route::post('/manage', [ soundpost::class, 'manage' ])->name('home.manage');

Route::get('/member_edit', [ soundpost::class, 'm_edit' ])->name('home.member_edit');
Route::post('/member_edit', [ soundpost::class, 'm_edit' ])->name('home.member_edit');

//退会
Route::get('/withdrawal', [ soundpost::class, 'withdrawal' ])->name('home.withdrawal');
Route::post('/withdrawal', [ soundpost::class, 'withdrawal' ])->name('home.withdrawal');

Route::get('/withdrawal_admin', [ soundpost::class, 'withdrawal_admin' ])->name('home.withdrawal_admin');
Route::post('/withdrawal_admin', [ soundpost::class, 'withdrawal_admin' ])->name('home.withdrawal_admin');

Route::get('/comment_post', [ soundpost::class, 'comment_post' ])->name('home.comment_post');
Route::post('/comment_post', [ soundpost::class, 'comment_post' ])->name('home.comment_post');
