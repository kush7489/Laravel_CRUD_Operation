<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mycontroller;

Route::get('/', [Mycontroller::class, 'index'])->name('index');
Route::post('/send', [Mycontroller::class, 'send'])->name('send');
Route::get('/edit_page', [Mycontroller::class, 'edit_page'])->name('edit_page');
Route::PUT('/update_data', [Mycontroller::class, 'update_data'])->name('update_data');
Route::DELETE('/delete_data', [Mycontroller::class, 'delete_data'])->name('delete_data');
Route::get('/images_delete/{id}/{imageIndex}', [Mycontroller::class, 'images_delete'])->name('images.delete');
Route::post('/upload_new_image', [Mycontroller::class, 'upload_new_image'])->name('upload_new_image');
Route::get('/delete_user/{id}', [Mycontroller::class, 'delete_user'])->name('delete_user');
Route::get('/show_data', [Mycontroller::class, 'show_data'])->name('show_data');
Route::get('/testing', [Mycontroller::class, 'testing'])->name('testing');
