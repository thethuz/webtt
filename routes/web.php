<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/id/{id}', function ($id) {
    echo "ID: " . $id;
})->name('info');
// Route::get('/name/{age?}',function($age=18){
// 	echo "Age: ".$age;
// });

//choose role and function to execute
Route::get('/role', [
    'middleware' => 'Role:editor',
    'uses' => 'TestController@index'
]);

Route::get('/terminate', [
    'middleware' => 'terminate',
    'uses' => 'ABCController@index'
]);

// Route::get('/login',function(){
// 	return view('login');
// });


Route::get('profile', ['middleware' => 'auth',
    'uses' => 'UserController@showPath'
]);

//middleware
Route::get('/UserController/path', [
    'middleware' => 'First',
    'uses' => 'UserController@showPath'
])->name('path');

//crud restfull
Route::resource('/my', 'MyController');

//just a test. can cause error when config:cache
// class MyPersonalClass{
//    public $foo = 'bar';
// }

Route::get('redirect', function () {
    return redirect()->route('test');
});
Route::get('rr', 'RedirectController@index');
Route::get('/redirectcontroller', function () {
    return redirect()->action('RedirectController@index');
});

Route::get('delete-records', 'StudDeleteController@index');
Route::get('delete/{id}', 'StudDeleteController@destroy');
Route::get('/form', function () {
    return view('form');
});

Route::get('session/get', 'SessionController@accessSessionData');
Route::get('session/set', 'SessionController@storeSessionData');
Route::get('session/remove', 'SessionController@deleteSessionData');

//Ajax
Route::get('ajax', function () {
    return view('message');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/{id}','UserController@showProfile');

//Routes for questions
Route::get('/questions/list','QuestionsController@showQuestionList');
Route::get('/questions/ask', 'QuestionsController@showAsk');
Route::post('/questions/ask', 'QuestionsController@ask')->name('questions.ask');
Route::post('/questions/answer', 'QuestionsController@answer')->name('questions.answer');

//Show information form
Route::get('/questions/{id}/', 'QuestionsController@showQuestionDetail')->name('questions.show');
Route::get('/questions/{id}/edit','QuestionsController@showEditQuestion');

//Update data
Route::post('/user/upload_avatar', 'UserController@uploadAvatar');
Route::post('/user/update_profile', 'UserController@updateProfile');

// Achieve constant have config data
Route::get('/api/get_constant','ConstantAPIController@get');
Route::get('/user/isAuthenticated', 'UserController@isAuthenticated');
Route::get('/user/getCurrentUserId','UserController@getCurrentUserId');

Route::get('/tag/{tag}','QuestionsController@showQuestionByTag');
Route::post('/vote_action', 'QuestionsController@voteAction')->middleware('auth');

Route::get('/answers/{id}', 'QuestionsController@getAnswersById');
