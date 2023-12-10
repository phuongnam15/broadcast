<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\DataMessage;

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
    $dataMessages = DataMessage::create([
        'user_id' => auth()->user()->id,
        'message' => $request->input('message')
    ]);
    broadcast(new MessageSent(auth()->user(), $request->input('message')));
    return $request->input('message');
});
Route::get('/get-message', function () {
    $dataMessages = DataMessage::with('user')->get();
    return $dataMessages;
});
Route::get('/login/{id}', function ($id) {
    Auth::loginUsingId($id);
    return back();
});
Route::get('/logout', function () {
    Auth::logout();
    return back();
});