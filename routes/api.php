<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
| fetch all request from axios
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(function () {
//});

Route::group(['prefix' => 'v1', 'as' => "api."], function () {
    Route::resource('answers', 'AnswersController');
    Route::resource('questions', 'QuestionsController')->names(['update'=>'questions.update']);
});

Route::group(['prefix' => 'api/v1'], function () {
    Route::resource('tags', 'TagsController');
});