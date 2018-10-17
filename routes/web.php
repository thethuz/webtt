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

Route::view('/','welcome');
Route::get('/id/{id}',function($id){	
	echo "ID: ".$id;
})->name('info');
// Route::get('/name/{age?}',function($age=18){
// 	echo "Age: ".$age;
// });

//choose role and function to execute
Route::get('/role',[
	'middleware'=>'Role:editor',
	'uses'=>'TestController@index'
]);

Route::get('/terminate',[
	'middleware' => 'terminate',
	'uses' => 'ABCController@index'
]);

Route::get('/login',function(){
	return view('login');
});


Route::get('profile',[
	'middleware' => 'auth',
	'uses' => 'UserController@showPath'
]);

//middleware
Route::get('/UserController/path',[
	'middleware' => 'First',
	'uses' => 'UserController@showPath'
])->name('path');

//crud restfull
Route::resource('/my','MyController');

class MyClass{
   public $foo = 'bar';
}
Route::get('/myclass','ImplicitController@index');

Route::get('/foo/barc','UriController@index');
Route::get('/register',function(){
	return view('register');
});
Route::post('/user/register',array('uses'=>'UserRegistration@postRegister'));
Route::get('/cookie/set','CookieController@setCookie');
Route::get('/cookie/get','CookieController@getCookie');
Route::get('/attach/cookie','CookieController@attachCookieAndHeader');
Route::get('/attach/json','CookieController@attachJSON');
Route::get('/test/template','TestController@index');
Route::get('/test', ['as'=>'testing',function(){
   return view('test');
}]);

Route::get('redirect',function(){
   return redirect()->route('test');
});
Route::get('rr','RedirectController@index');
Route::get('/redirectcontroller',function(){
   return redirect()->action('RedirectController@index');
});
Route::get('view-records','StudViewController@index');
