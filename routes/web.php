<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    // Build a path to the post's HTML file
    // check to see if the file exists
    if (!file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        return redirect('/');
    }
    // fetch the contents of that file
    // set $post variable to cache the contents
    $post = cache()->remember("posts.{$slug}", 5, function () use ($path) {
        var_dump('files_get_contents');
        return file_get_contents($path);
    });
    // pass content to the view
    return view('post', [
        'post' => $post
    ]);
    //this is where wildcard constraint are written {where('post', '[A-z_\-]+')}
})->where('post', '[A-z_\-]+');
