<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/chat', function () {
    return view('chat');
});
Route::post('/message', function (Request $request) {
    broadcast(new MessageSent(auth()->user(), $request->input('message')));
    return $request->input('message');
});
Route::get('/login/{id}', function ($id) {
    Auth::loginUsingId($id);
    return back();
});
Route::get('/logout', function () {
    Auth::logout();
    return back();
});