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
Route::get('/myclass', 'ImplicitController@index');

Route::get('/foo/barc', 'UriController@index');
Route::post('/user/register', array('uses' => 'UserRegistration@postRegister'));

Route::get('/cookie/set', 'CookieController@setCookie');
Route::get('/cookie/get', 'CookieController@getCookie');
Route::get('/attach/cookie', 'CookieController@attachCookieAndHeader');
Route::get('/attach/json', 'CookieController@attachJSON');

Route::get('/test/template', 'TestController@index');
Route::get('/test', ['as' => 'testing', function () {
    return view('test');
}]);

Route::get('redirect', function () {
    return redirect()->route('test');
});
Route::get('rr', 'RedirectController@index');
Route::get('/redirectcontroller', function () {
    return redirect()->action('RedirectController@index');
});

Route::get('view-records', 'StudViewController@index');
Route::get('insert', 'StudInsertController@insertform');
Route::post('create', 'StudInsertController@insert');

Route::get('edit-records', 'StudUpdateController@index');
Route::get('edit/{id}', 'StudUpdateController@show');
Route::post('edit/{id}', 'StudUpdateController@edit');

Route::get('delete-records', 'StudDeleteController@index');
Route::get('delete/{id}', 'StudDeleteController@destroy');
Route::get('/form', function () {
    return view('form');
});

Route::get('session/get', 'SessionController@accessSessionData');
Route::get('session/set', 'SessionController@storeSessionData');
Route::get('session/remove', 'SessionController@deleteSessionData');

Route::get('/validation', 'ValidationController@showform');
Route::post('/validation', 'ValidationController@validateform');

Route::get('/uploadfile', 'UploadFileController@index');
Route::post('/uploadfile', 'UploadFileController@showUploadFile');

//Email
Route::get('sendbasicemail', 'MailController@basic_email');
Route::get('sendhtmlemail', 'MailController@html_email');
Route::get('sendattachmentemail', 'MailController@attachment_email');

//Ajax
Route::get('ajax', function () {
    return view('message');
});
Route::get('/getmsg', 'AjaxController@index');


Route::get('/facadeex', function () {
    return TestFacades::testingFacades();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/{id}','UserController@showProfile');
Route::get('/question/list','QuestionController@showQuestionList');